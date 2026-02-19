<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delivery Messages</title>

    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="resources/icon.png">

    <style>
        .file-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 6px 0;
        }

        .file-preview .file-item {
            background-color: #f0f0f0;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .file-preview .remove-file {
            cursor: pointer;
            color: #ff4d4f;
            font-weight: bold;
        }

        .imageBox {
            height: 100px;
            width: 150px;
            object-fit: cover;
        }

        /* ── Chat header ── */
        .chat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-bottom: 1px solid #e0e0e0;
            min-height: 54px;
        }

        .chat-header-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #4f6ef7;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            object-fit: cover;
        }

        .chat-header-name {
            font-weight: 600;
            font-size: 15px;
            color: #1a1a2e;
        }

        .chat-header-placeholder {
            color: #999;
            font-size: 14px;
            font-style: italic;
        }

        /* ── Unread badge ── */
        .unread-badge {
            background: #ff4d4f;
            color: #fff;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            line-height: 1;
        }
    </style>
</head>

<body>

<?php
    $activePage = 'messeges';
    include 'views/commonElements/leftSidebarSaneth.php';

    /* =======================
       GROUP MESSAGES (PHP)
       ======================= */

    $groupedMessages = [];

    foreach ($myMessages as $row) {
        $key = $row['client_id'] . '|' . $row['messege'] . '|' . $row['created_at'];

        if (! isset($groupedMessages[$key])) {
            $groupedMessages[$key] = [
                'clientName'   => $row['client'],
                'client_id'    => $row['client_id'],
                'messege'      => $row['messege'],
                'created_at'   => $row['created_at'],
                'sent'         => $row['sent'],
                'attachments'  => [],
                'unread'       => 0,
                'client_image' => $row['client_image'] ?? null,
            ];
        }

        // sent = 0 means received from client (not yet read by delivery person)
        if ($row['sent'] && !$row['is_read']) {
            $groupedMessages[$key]['unread']++;
        }

        if (! empty($row['file_loc'])) {
            $groupedMessages[$key]['attachments'][] = $row['file_loc'];
        }
    }

    // Build clients map: id => { name, unread, client_image }
    $clients = [];
    foreach ($groupedMessages as $msg) {
        if (! empty($msg['client_id'])) {
            $id = $msg['client_id'];
            $clients[$id] = [
                'name'         => $msg['clientName'],
                'unread'       => ($clients[$id]['unread'] ?? 0) + $msg['unread'],
                'client_image' => $msg['client_image'] ?? null,
            ];
        }
    }
?>

<div class="container">
    <div class="main-content">
        <div class="chat-dashboard">

            <!-- =======================
                 CLIENT LIST
                 ======================= -->
            <div class="mesager-list" id="clientList">
                <div class="bold">Clients</div>
            </div>

            <!-- =======================
                 MESSAGE BOX
                 ======================= -->
            <div class="message-box">

                <!-- Dynamic header: avatar + name -->
                <div class="chat-header" id="chatHeader">
                    <span class="chat-header-placeholder">Select a conversation</span>
                </div>

                <div class="message-history" id="messageHistory"></div>

                <div class="message-input">
                    <label for="fileInput" class="attachment-button">📎</label>
                    <input type="file" id="fileInput" multiple hidden onchange="handleFileAttach(event)">

                    <input type="text" id="messageInput"
                        placeholder="Type your message..."
                        onkeypress="handleKeyPress(event)">

                    <button onclick="sendMessage()" class="btn1">Send</button>
                </div>

                <div id="filePreview" class="file-preview"></div>
            </div>

        </div>
    </div>
</div>

<script>
const GROUPED_MESSAGES = <?php echo json_encode(array_values($groupedMessages)) ?>;
const CLIENTS          = <?php echo json_encode($clients) ?>;
const CLIENT_ID        = <?php echo (int) $client_id ?>;

let currentClientId = null;
let attachedFiles   = [];

/* =======================
   AVATAR HELPERS
   ======================= */
function getInitials(name) {
    if (!name) return '?';
    const words = name.trim().split(/\s+/);
    if (words.length >= 2) return (words[0][0] + words[1][0]).toUpperCase();
    return name.substring(0, 2).toUpperCase();
}

function nameToColor(name) {
    const palette = [
        '#4f6ef7', '#e05c5c', '#2ecc71', '#e67e22',
        '#9b59b6', '#1abc9c', '#e91e63', '#3498db'
    ];
    let hash = 0;
    for (let i = 0; i < name.length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash);
    return palette[Math.abs(hash) % palette.length];
}

/* =======================
   UPDATE CHAT HEADER
   ======================= */
function updateChatHeader(name, image = null) {
    const header = document.getElementById('chatHeader');
    if (!name) {
        header.innerHTML = `<span class="chat-header-placeholder">Select a conversation</span>`;
        return;
    }

    const avatarHtml = image
        ? `<img src="${image}" class="chat-header-avatar" style="object-fit:cover;">`
        : `<div class="chat-header-avatar" style="background:${nameToColor(name)};">${getInitials(name)}</div>`;

    header.innerHTML = `
        ${avatarHtml}
        <span class="chat-header-name">${escapeHtml(name)}</span>
    `;
}

/* =======================
   RENDER CLIENTS  (sorted: unread first)
   ======================= */
function renderClients() {
    const list  = document.getElementById('clientList');
    const title = list.querySelector('.bold').outerHTML;
    list.innerHTML = title;

    const sorted = Object.entries(CLIENTS).sort(([, a], [, b]) => b.unread - a.unread);

    sorted.forEach(([id, info]) => {
        const p = document.createElement('p');
        p.className        = 'client-item';
        p.dataset.clientId = id;
        p.style.display        = 'flex';
        p.style.alignItems     = 'center';
        p.style.justifyContent = 'space-between';
        p.onclick = () => selectClient(id, p);

        const badge = info.unread > 0
            ? `<span class="unread-badge">${info.unread}</span>`
            : '';

        p.innerHTML = `
            <span class="contact-name">${escapeHtml(info.name)}</span>
            ${badge}
        `;

        list.appendChild(p);
    });
}

/* =======================
   RENDER MESSAGES
   ======================= */
function renderMessages(clientId) {
    const history = document.getElementById('messageHistory');
    history.innerHTML = '';

    GROUPED_MESSAGES
        .filter(m => m.client_id == clientId)
        .forEach(msg => {
            const div = document.createElement('div');
            div.className = `message ${msg.sent ? 'user' : 'other'}`;

            div.innerHTML = `
                <div class="text">${escapeHtml(msg.messege)}</div>

                ${msg.attachments.length ? `
                    <div class="attachments">
                        ${msg.attachments.map(f =>
                            `<img src="resources/uploads/delivery/attatchments/${f}" class="imageBox">`
                        ).join('')}
                    </div>
                ` : ''}

                <div class="timestamp">${msg.created_at}</div>
            `;

            history.appendChild(div);
        });

    history.scrollTop = history.scrollHeight;
}

/* =======================
   CLIENT SELECT
   ======================= */
function selectClient(clientId, el) {
    document.querySelectorAll('.client-item')
        .forEach(p => p.classList.remove('active'));

    el.classList.add('active');
    currentClientId = clientId;

    const info = CLIENTS[clientId];
    updateChatHeader(info ? info.name : clientId, info?.client_image ?? null);

    renderMessages(clientId);

    // Clear badge locally and persist to DB
    if (info && info.unread > 0) {
        info.unread = 0;
        const badge = el.querySelector('.unread-badge');
        if (badge) badge.remove();

        markAsRead(clientId);
    }
}

/* =======================
   MARK AS READ (AJAX)
   ======================= */
function markAsRead(clientId) {
    fetch(`?controller=delivery&action=dashboard/messeges/markRead/${clientId}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ clientId })
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) {
            console.warn('markAsRead failed for client', clientId);
        }
    })
    .catch(err => console.error('markAsRead error:', err));
}

/* =======================
   SEND MESSAGE
   ======================= */
function sendMessage() {
    if (!currentClientId) currentClientId = <?php echo json_encode($client_id); ?>;
    const input   = document.getElementById('messageInput');
    const message = input.value.trim();

    if (!message && attachedFiles.length === 0) return;

    const formData = new FormData();
    formData.append('message', message);
    attachedFiles.forEach(f => formData.append('attachments[]', f));

    fetch(`?controller=delivery&action=dashboard/messeges/send/${currentClientId}`, {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            sessionStorage.setItem('activeClientId', currentClientId);
            location.reload();
        }
    });
}

/* =======================
   FILE HANDLING
   ======================= */
function handleFileAttach(e) {
    attachedFiles.push(...e.target.files);
    updateFilePreview();
    e.target.value = '';
}

function updateFilePreview() {
    const preview = document.getElementById('filePreview');
    preview.innerHTML = '';

    attachedFiles.forEach((f, i) => {
        preview.innerHTML += `
            <div class="file-item">
                ${f.name}
                <span class="remove-file" onclick="removeFile(${i})">&times;</span>
            </div>
        `;
    });
}

function removeFile(i) {
    attachedFiles.splice(i, 1);
    updateFilePreview();
}

function handleKeyPress(e) {
    if (e.key === 'Enter') sendMessage();
}

/* =======================
   HELPERS
   ======================= */
function escapeHtml(str) {
    const d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
}

/* =======================
   INIT
   ======================= */
renderClients();

document.addEventListener('DOMContentLoaded', () => {
    const savedClientId    = sessionStorage.getItem('activeClientId');
    const clientIdToSelect = savedClientId ?? CLIENT_ID;

    const el = document.querySelector(
        `.client-item[data-client-id="${clientIdToSelect}"]`
    );

    if (el) el.click();

    sessionStorage.removeItem('activeClientId');
});
</script>

</body>
</html>