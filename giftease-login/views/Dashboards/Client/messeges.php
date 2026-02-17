<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Messages</title>

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
        .contact-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

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
    include 'views/commonElements/leftSidebarDilma.php';

    /* =======================
   GROUP MESSAGES
   ======================= */

    $groupedMessagesVendors = [];
    $groupedMessagesGiftWrapper = [];
    $groupedMessagesDelivery = [];

    if ($direct) {
        var_dump($directID);
        if ($directType === 'vendor') {
            $groupedMessagesVendors['direct'] = [
                'shopName'   => $staffData,
                'vendor_id'  => $directID,
                'messege'    => "Contact " . $staffData . " Now",
                'created_at' => '',
                'unread'     => 0
            ];
        } else if ($directType === 'giftwrapper') {
            $groupedMessagesGiftWrapper['direct'] = [
                'giftWrapper'    => $staffData,
                'giftWrapper_id' => $directID,
                'messege'        => "Contact " . $staffData . " Now",
                'created_at'     => '',
                'unread'         => 0
            ];
        } else if ($directType === 'delivery') {
            $groupedMessagesDelivery['direct'] = [
                'delivery'    => $staffData,
                'delivery_id' => $directID,
                'messege'     => "Contact " . $staffData . " Now",
                'created_at'  => '',
                'unread'      => 0
            ];
        }
    }

    foreach ($myMessages as $row) {

        $keyVendor   = $row['vendor_id'] . '|' . $row['messege'] . '|' . $row['created_at'];
        $keyGift     = $row['giftWrapper_id'] . '|' . $row['messege'] . '|' . $row['created_at'];
        $keyDelivery = $row['delivery_id'] . '|' . $row['messege'] . '|' . $row['created_at'];

        if (!isset($groupedMessagesVendors[$keyVendor])) {
            $groupedMessagesVendors[$keyVendor] = [
                'shopName'    => $row['shopName'],
                'vendor_id'   => $row['vendor_id'],
                'messege'     => $row['messege'],
                'created_at'  => $row['created_at'],
                'sent'        => $row['sent'],
                'attachments' => [],
                'unread'      => 0
            ];
        }
        // Count unread messages per vendor thread
        if (empty($row['sent']) && isset($row['is_read']) && !$row['is_read']) {
            $groupedMessagesVendors[$keyVendor]['unread']++;
        }

        if (!isset($groupedMessagesGiftWrapper[$keyGift])) {
            $groupedMessagesGiftWrapper[$keyGift] = [
                'giftWrapper'    => $row['giftWrapper'],
                'giftWrapper_id' => $row['giftWrapper_id'],
                'messege'        => $row['messege'],
                'created_at'     => $row['created_at'],
                'sent'           => $row['sent'],
                'attachments'    => [],
                'unread'         => 0
            ];
        }
        if (empty($row['sent']) && isset($row['is_read']) && !$row['is_read']) {
            $groupedMessagesGiftWrapper[$keyGift]['unread']++;
        }

        if (!isset($groupedMessagesDelivery[$keyDelivery])) {
            $groupedMessagesDelivery[$keyDelivery] = [
                'delivery'    => $row['delivery'],
                'delivery_id' => $row['delivery_id'],
                'messege'     => $row['messege'],
                'created_at'  => $row['created_at'],
                'sent'        => $row['sent'],
                'attachments' => [],
                'unread'      => 0
            ];
        }
        if (empty($row['sent']) && isset($row['is_read']) && !$row['is_read']) {
            $groupedMessagesDelivery[$keyDelivery]['unread']++;
        }

        if (!empty($row['file_loc'])) {
            $groupedMessagesVendors[$keyVendor]['attachments'][]   = $row['file_loc'];
            $groupedMessagesGiftWrapper[$keyGift]['attachments'][]  = $row['file_loc'];
            $groupedMessagesDelivery[$keyDelivery]['attachments'][] = $row['file_loc'];
        }
    }

    /* =======================
       BUILD STAFF MAPS WITH UNREAD COUNTS
       ======================= */
    $vendors      = [];  // [id => ['name' => ..., 'unread' => n]]
    $giftwrappers = [];
    $delivery     = [];

    foreach ($groupedMessagesVendors as $m)
        if (!empty($m['vendor_id']))
            $vendors[$m['vendor_id']] = [
                'name'   => $m['shopName'],
                'unread' => ($vendors[$m['vendor_id']]['unread'] ?? 0) + $m['unread']
            ];

    foreach ($groupedMessagesGiftWrapper as $m)
        if (!empty($m['giftWrapper_id']))
            $giftwrappers[$m['giftWrapper_id']] = [
                'name'   => $m['giftWrapper'],
                'unread' => ($giftwrappers[$m['giftWrapper_id']]['unread'] ?? 0) + $m['unread']
            ];

    foreach ($groupedMessagesDelivery as $m)
        if (!empty($m['delivery_id']))
            $delivery[$m['delivery_id']] = [
                'name'   => $m['delivery'],
                'unread' => ($delivery[$m['delivery_id']]['unread'] ?? 0) + $m['unread']
            ];
    ?>

    <div class="container">
        <div class="main-content">
            <div class="chat-dashboard">

                <div class="mesager-list">
                    <div id="vendorList">
                        <div class="bold">Vendors</div>
                    </div>
                    <div id="giftWrapperList">
                        <div class="bold">Gift Wrappers</div>
                    </div>
                    <div id="deliveryList">
                        <div class="bold">Delivery</div>
                    </div>
                </div>

                <div class="message-box">
                    <!-- Dynamic header: replaced "Messages" with avatar + name -->
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
        /* =======================
   DATA
   ======================= */
        const GROUPED_MESSAGES = {
            vendor: <?= json_encode(array_values($groupedMessagesVendors)) ?>,
            giftwrapper: <?= json_encode(array_values($groupedMessagesGiftWrapper)) ?>,
            delivery: <?= json_encode(array_values($groupedMessagesDelivery)) ?>
        };

        // STAFF now carries { id: { name, unread } }
        const STAFF = {
            vendor: <?= json_encode($vendors) ?>,
            giftwrapper: <?= json_encode($giftwrappers) ?>,
            delivery: <?= json_encode($delivery) ?>
        };

        let activeType = null;
        let activeId   = null;

        const DIRECT_DATA = {
            direct: <?= json_encode($direct ?? 0) ?>,
            type:   <?= json_encode($directType ?? null) ?>,
            id:     <?= json_encode($directID ?? null) ?>
        };

        /* =======================
           AUTO SELECT
           ======================= */
        function autoSelectDirectChat() {
            if (!DIRECT_DATA || DIRECT_DATA.direct != 1) return;

            const { type, id } = DIRECT_DATA;

            const typeClassMap = {
                vendor:      '.vendor-item',
                giftwrapper: '.giftwrapper-item',
                delivery:    '.delivery-item'
            };

            const selector = `${typeClassMap[type]}[data-id="${id}"]`;
            const el = document.querySelector(selector);

            if (!el) {
                console.warn('Direct chat element not found:', selector);
                return;
            }

            selectChat(type, id, el);
        }

        let attachedFiles = [];

        /* =======================
           CONFIG
           ======================= */
        const FILTER_KEY = {
            vendor:      'vendor_id',
            giftwrapper: 'giftWrapper_id',
            delivery:    'delivery_id'
        };

        const PATH = {
            vendor:      'resources/uploads/vendor/attatchments',
            giftwrapper: 'resources/uploads/giftWrapper/attatchments',
            delivery:    'resources/uploads/delivery/attatchments'
        };

        /* =======================
           AVATAR HELPERS
           ======================= */
        /**
         * Returns 1–2 initials from a name string.
         * e.g. "Fresh Farms" → "FF", "Acme" → "AC"
         */
        function getInitials(name) {
            if (!name) return '?';
            const words = name.trim().split(/\s+/);
            if (words.length >= 2) return (words[0][0] + words[1][0]).toUpperCase();
            return name.substring(0, 2).toUpperCase();
        }

        /** Consistent hue from a string so each contact gets its own colour */
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
        function updateChatHeader(name) {
            const header = document.getElementById('chatHeader');
            if (!name) {
                header.innerHTML = `<span class="chat-header-placeholder">Select a conversation</span>`;
                return;
            }

            const initials = getInitials(name);
            const color    = nameToColor(name);

            header.innerHTML = `
                <div class="chat-header-avatar" style="background:${color};">${initials}</div>
                <span class="chat-header-name">${escapeHtml(name)}</span>
            `;
        }

        /* =======================
           RENDER STAFF  (sorted: unread first)
           ======================= */
        function renderStaff(type, listId, className) {
            const list  = document.getElementById(listId);
            const title = list.querySelector('.bold').outerHTML;
            list.innerHTML = title;

            // Sort: contacts with unread messages appear first
            const sorted = Object.entries(STAFF[type]).sort(([, a], [, b]) => b.unread - a.unread);

            sorted.forEach(([id, info]) => {
                const p = document.createElement('p');
                p.className   = className;
                p.dataset.id  = id;
                p.onclick     = () => selectChat(type, id, p);

                const badge = info.unread > 0
                    ? `<span class="unread-badge">${info.unread}</span>`
                    : '';

                p.innerHTML = `
                    <span class="contact-name">${escapeHtml(info.name)}</span>
                    ${badge}
                `;
                p.style.display = 'flex';
                p.style.alignItems = 'center';
                p.style.justifyContent = 'space-between';

                list.appendChild(p);
            });
        }

        /* =======================
           RENDER MESSAGES
           ======================= */
        function renderMessages(type, id) {
            const history = document.getElementById('messageHistory');
            history.innerHTML = '';

            GROUPED_MESSAGES[type]
                .filter(m => m[FILTER_KEY[type]] == id)
                .forEach(msg => {
                    const div = document.createElement('div');
                    div.className = `message ${msg.sent ? 'other' : 'user'}`;

                    div.innerHTML = `
                        <div class="text">${escapeHtml(msg.messege)}</div>

                        ${msg.attachments?.length ? `
                            <div class="attachments">
                                ${msg.attachments.map(f =>
                                    `<img src="${PATH[type]}/${f}" class="imageBox">`
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
           SELECT CHAT
           ======================= */
        function selectChat(type, id, el) {
            document
                .querySelectorAll('.vendor-item, .giftwrapper-item, .delivery-item')
                .forEach(p => p.classList.remove('active'));

            el.classList.add('active');
            activeType = type;
            activeId   = id;

            // Update the chat header with this contact's name
            const info = STAFF[type][id];
            updateChatHeader(info ? info.name : id);

            renderMessages(type, id);

            // If there are unread messages, clear them locally and persist to DB
            if (info && info.unread > 0) {
                info.unread = 1;
                const badge = el.querySelector('.unread-badge');
                if (badge) badge.remove();

                markAsRead(type, id);
            }
        }

        /* =======================
           MARK AS READ (AJAX)
           ======================= */
        function markAsRead(type, id) {
            fetch(`?controller=client&action=dashboard/messeges/${type}/markRead/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type, id })
            })
            .then(r => r.json())
            .then(data => {
                if (!data.success) {
                    console.warn('markAsRead failed for', type, id);
                }
            })
            .catch(err => console.error('markAsRead error:', err));
        }

        /* =======================
           SEND MESSAGE
           ======================= */
        function sendMessage() {
            if (!activeType || !activeId) return alert('Select a chat');

            const input   = document.getElementById('messageInput');
            const message = input.value.trim();
            if (!message && !attachedFiles.length) return;

            const formData = new FormData();
            formData.append('message', message);
            attachedFiles.forEach(f => formData.append('attachments[]', f));

            fetch(`?controller=client&action=dashboard/messeges/${activeType}/send/${activeId}`, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) return;

                    GROUPED_MESSAGES[activeType].push({
                        [FILTER_KEY[activeType]]: activeId,
                        messege:    message,
                        created_at: 'Just now',
                        sent:       1,
                        attachments: []
                    });

                    input.value   = '';
                    attachedFiles = [];
                    updateFilePreview();
                    renderMessages(activeType, activeId);
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
                    </div>`;
            });
        }

        

        function removeFile(i) {
            attachedFiles.splice(i, 1);
            updateFilePreview();
        }

        function handleKeyPress(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
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
        document.addEventListener('DOMContentLoaded', () => {
            renderStaff('vendor',      'vendorList',      'vendor-item');
            renderStaff('giftwrapper', 'giftWrapperList', 'giftwrapper-item');
            renderStaff('delivery',    'deliveryList',    'delivery-item');

            if (DIRECT_DATA.direct == 1) {
                autoSelectDirectChat();
            }
        });
    </script>

</body>

</html>