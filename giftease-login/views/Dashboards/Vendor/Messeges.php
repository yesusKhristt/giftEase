<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>client Messages</title>

    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" type="image/png" href="resources/1.png">
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
    </style>
</head>

<body>

<?php
    $activePage = 'messeges';
    include 'views/commonElements/leftSidebarDilma.php';

    /* =======================
       GROUP MESSAGES (PHP)
       ======================= */

    $groupedMessages = [];

    foreach ($myMessages as $row) {
        $key = $row['client_id'] . '|' . $row['messege'] . '|' . $row['created_at'];

        if (! isset($groupedMessages[$key])) {
            $groupedMessages[$key] = [
                'clientName'       => $row['client'],
                'client_id'      => $row['client_id'],
                'messege'        => $row['messege'],
                'created_at'     => $row['created_at'],
                'sent'           => $row['sent'],
                'attachments'    => [],
            ];
        }

        if (! empty($row['file_loc'])) {
            $groupedMessages[$key]['attachments'][] = $row['file_loc'];
        }
    }

    $clients = [];
    foreach ($groupedMessages as $msg) {
        if (! empty($msg['client_id'])) {
            $clients[$msg['client_id']] = $msg['clientName'];
        }
    }
?>

<div class="container">
    <div class="main-content">
        <div class="chat-dashboard">

            <!-- =======================
                 client LIST
                 ======================= -->
            <div class="mesager-list" id="clientList">
                <div class="bold">client</div>
            </div>

            <!-- =======================
                 MESSAGE BOX
                 ======================= -->
            <div class="message-box">
                <div class="bold">Messages</div>

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

<!-- =======================
     DATA FROM PHP → JS
     ======================= -->
<script>
const GROUPED_MESSAGES =                         <?php echo json_encode(array_values($groupedMessages)) ?>;
const CLIENTS =                <?php echo json_encode($clients) ?>;
const client_ID =                 <?php echo (int) $client_id ?>;
let currentClientId = null;
let attachedFiles = [];

/* =======================
   RENDER VENDORS
   ======================= */
function renderClients() {
    const list = document.getElementById('clientList');

    Object.entries(CLIENTS).forEach(([id, name]) => {
        const p = document.createElement('p');
        p.className = 'client-item';
        p.dataset.clientId = id;
        p.textContent = name;
        p.onclick = () => selectClient(id, p);
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
                            `<img src="resources/uploads/vendor/attatchments/${f}" class="imageBox">`
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
   client SELECT
   ======================= */
function selectClient(clientId, el) {
    document.querySelectorAll('.client-item')
        .forEach(p => p.classList.remove('active'));

    el.classList.add('active');
    currentClientId = clientId;
    renderMessages(clientId);
}

/* =======================
   SEND MESSAGE
   ======================= */
function sendMessage() {
    if (!currentClientId)currentClientId = <?php echo json_encode($client_id); ?>;
    const input = document.getElementById('messageInput');
    const message = input.value.trim();

    if (!message && attachedFiles.length === 0) return;

    const formData = new FormData();
    formData.append('message', message);
    attachedFiles.forEach(f => formData.append('attachments[]', f));

    fetch(`?controller=vendor&action=dashboard/messeges/send/${currentClientId}`, {
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
    const savedClientId = sessionStorage.getItem('activeClientId');

    let clientIdToSelect = savedClientId ?? client_ID;

    const el = document.querySelector(
        `.client-item[data-client-id="${clientIdToSelect}"]`
    );

    if (el) el.click();

    // cleanup so normal navigation works later
    sessionStorage.removeItem('activeClientId');
});

</script>

</body>
</html>

