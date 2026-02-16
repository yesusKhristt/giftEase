<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Messages</title>

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
                'created_at' => ''
            ];
        } else if ($directType === 'giftwrapper') {
            $groupedMessagesGiftWrapper['direct'] = [
                'giftWrapper'   => $staffData,
                'giftWrapper_id'  => $directID,
                'messege'    => "Contact " . $staffData . " Now",
                'created_at' => ''
            ];
        } else if ($directType === 'delivery') {
            $groupedMessagesDelivery['direct'] = [
                'delivery'   => $staffData,
                'delivery_id'  => $directID,
                'messege'    => "Contact " . $staffData . " Now",
                'created_at' => ''
            ];
        }
    }

    foreach ($myMessages as $row) {

        $keyVendor   = $row['vendor_id'] . '|' . $row['messege'] . '|' . $row['created_at'];
        $keyGift     = $row['giftWrapper_id'] . '|' . $row['messege'] . '|' . $row['created_at'];
        $keyDelivery = $row['delivery_id'] . '|' . $row['messege'] . '|' . $row['created_at'];

        if (!isset($groupedMessagesVendors[$keyVendor])) {
            $groupedMessagesVendors[$keyVendor] = [
                'shopName'   => $row['shopName'],
                'vendor_id'  => $row['vendor_id'],
                'messege'    => $row['messege'],
                'created_at' => $row['created_at'],
                'sent'       => $row['sent'],
                'attachments' => []
            ];
        }

        if (!isset($groupedMessagesGiftWrapper[$keyGift])) {
            $groupedMessagesGiftWrapper[$keyGift] = [
                'giftWrapper'    => $row['giftWrapper'],
                'giftWrapper_id' => $row['giftWrapper_id'],
                'messege'        => $row['messege'],
                'created_at'     => $row['created_at'],
                'sent'           => $row['sent'],
                'attachments'    => []
            ];
        }

        if (!isset($groupedMessagesDelivery[$keyDelivery])) {
            $groupedMessagesDelivery[$keyDelivery] = [
                'delivery'    => $row['delivery'],
                'delivery_id' => $row['delivery_id'],
                'messege'     => $row['messege'],
                'created_at'  => $row['created_at'],
                'sent'        => $row['sent'],
                'attachments' => []
            ];
        }

        if (!empty($row['file_loc'])) {
            $groupedMessagesVendors[$keyVendor]['attachments'][] = $row['file_loc'];
            $groupedMessagesGiftWrapper[$keyGift]['attachments'][] = $row['file_loc'];
            $groupedMessagesDelivery[$keyDelivery]['attachments'][] = $row['file_loc'];
        }
    }

    $vendors = [];
    $giftwrappers = [];
    $delivery = [];

    foreach ($groupedMessagesVendors as $m)
        if (!empty($m['vendor_id'])) $vendors[$m['vendor_id']] = $m['shopName'];

    foreach ($groupedMessagesGiftWrapper as $m)
        if (!empty($m['giftWrapper_id'])) $giftwrappers[$m['giftWrapper_id']] = $m['giftWrapper'];

    foreach ($groupedMessagesDelivery as $m)
        if (!empty($m['delivery_id'])) $delivery[$m['delivery_id']] = $m['delivery'];
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



    <script>
        /* =======================
   DATA
   ======================= */
        const GROUPED_MESSAGES = {
            vendor: <?= json_encode(array_values($groupedMessagesVendors)) ?>,
            giftwrapper: <?= json_encode(array_values($groupedMessagesGiftWrapper)) ?>,
            delivery: <?= json_encode(array_values($groupedMessagesDelivery)) ?>
        };

        const STAFF = {
            vendor: <?= json_encode($vendors) ?>,
            giftwrapper: <?= json_encode($giftwrappers) ?>,
            delivery: <?= json_encode($delivery) ?>
        };

        let activeType = null;
        let activeId = null;

        const DIRECT_DATA = {
            direct: <?= json_encode($direct ?? 0) ?>,
            type: <?= json_encode($directType ?? null) ?>,
            id: <?= json_encode($directID ?? null) ?>
        };

        /* =======================
           AUTO SELECT
           ======================= */
        function autoSelectDirectChat() {
            if (!DIRECT_DATA || DIRECT_DATA.direct != 1) return;

            const {
                type,
                id
            } = DIRECT_DATA;

            const typeClassMap = {
                vendor: '.vendor-item',
                giftwrapper: '.giftwrapper-item',
                delivery: '.delivery-item'
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
            vendor: 'vendor_id',
            giftwrapper: 'giftWrapper_id',
            delivery: 'delivery_id'
        };

        const PATH = {
            vendor: 'resources/uploads/vendor/attatchments',
            giftwrapper: 'resources/uploads/giftWrapper/attatchments',
            delivery: 'resources/uploads/delivery/attatchments'
        };

        /* =======================
           RENDER STAFF
           ======================= */
        function renderStaff(type, listId, className) {
            const list = document.getElementById(listId);
            const title = list.querySelector('.bold').outerHTML;
            list.innerHTML = title;

            Object.entries(STAFF[type]).forEach(([id, name]) => {
                const p = document.createElement('p');
                p.className = className;
                p.dataset.id = id;
                p.textContent = name;
                p.onclick = () => selectChat(type, id, p);
                list.appendChild(p);
            });
        }

        function loadMesseges(type, id) {
            Object.entries(STAFF[type]).forEach(([id, name]) => {
                const p = document.createElement('p');
                p.className = className;
                p.dataset.id = id;
                p.textContent = name;
                renderMessages(type, id);
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
            activeId = id;

            renderMessages(type, id);
        }

        /* =======================
           SEND MESSAGE
           ======================= */
        function sendMessage() {
            if (!activeType || !activeId) return alert('Select a chat');

            const input = document.getElementById('messageInput');
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
                        messege: message,
                        created_at: 'Just now',
                        sent: 1,
                        attachments: []
                    });

                    input.value = '';
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
            renderStaff('vendor', 'vendorList', 'vendor-item');
            renderStaff('giftwrapper', 'giftWrapperList', 'giftwrapper-item');
            renderStaff('delivery', 'deliveryList', 'delivery-item');

            if (DIRECT_DATA.direct == 1) {
                autoSelectDirectChat(); // ✅ works now
            }
        });
    </script>




</body>

</html>