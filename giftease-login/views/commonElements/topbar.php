<header class="browse-header">
    <div class="falling-gifts">
    </div>

    <div class="topbar-container" style="display: flex; align-items: center; padding: 10px 20px;">
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search..." />
            <div id="search-count" style="margin-top:6px;font-size:13px;color:#555;">
            </div>
        </div>

        <div class="gift">
            gift<span class="Ease">Ease
            </span>
        </div>

        <!-- Right Side Links/Buttons -->
        <nav class="topbar-actions">
            <div class="notification-wrapper" style="position:relative; display:inline-block; margin-right:12px;">
                <button id="notifBell" style="background:none;border:0;cursor:pointer;position:relative;">
                    <i class="fas fa-bell"></i>
                    <span id="notifCount" style="background:#e53935;color:#fff;padding:2px 6px;border-radius:12px;font-size:0.75rem;position:absolute;top:-6px;right:-8px;display:none">0</span>
                </button>
                <div id="notifDropdown" style="display:none;position:absolute;right:0;top:28px;width:320px;background:#fff;border:1px solid #ddd;box-shadow:0 4px 12px rgba(0,0,0,0.08);z-index:999;padding:8px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                        <strong>Notifications</strong>
                        <button id="markAllReadBtn" style="background:none;border:0;color:#555;cursor:pointer;font-size:0.85rem">Mark all read</button>
                    </div>
                    <ul id="notifList" style="list-style:none;padding:0;margin:0;max-height:300px;overflow:auto;"></ul>
                    <div style="text-align:center;padding-top:8px;font-size:0.85rem;color:#666;"><a href="#">View all</a></div>
                </div>
            </div>

            <a href="#" id="loginLink">Login</a>
            <a href="#" id="signupLink">Sign Up</a>
            <a href="#" class="settings-btn">
                <i class="fas fa-cog"></i>
            </a>
        </nav>

        <script>
            (function() {
                const bell = document.getElementById('notifBell');
                const countEl = document.getElementById('notifCount');
                const dropdown = document.getElementById('notifDropdown');
                const listEl = document.getElementById('notifList');
                const markAllBtn = document.getElementById('markAllReadBtn');

                async function fetchCount() {
                    try {
                        let res = await fetch('?controller=notification&action=count');
                        let data = await res.json();
                        const c = data.count || 0;
                        if (c > 0) {
                            countEl.style.display = 'inline-block';
                            countEl.textContent = c;
                        } else {
                            countEl.style.display = 'none';
                        }
                    } catch (e) {
                        console.error('notif count error', e);
                    }
                }

                async function fetchList() {
                    try {
                        let res = await fetch('?controller=notification&action=list');
                        let data = await res.json();
                        listEl.innerHTML = '';
                        if (!data || data.length === 0) {
                            listEl.innerHTML = '<li style="padding:8px;color:#666">No notifications</li>';
                            return;
                        }
                        data.forEach(n => {
                            const li = document.createElement('li');
                            li.style.padding = '8px';
                            li.style.borderBottom = '1px solid #eee';
                            li.innerHTML = `<div style="font-size:0.95rem">${n.message}</div><div style="font-size:0.8rem;color:#888">${n.created_at}</div>`;
                            li.onclick = async () => {
                                // mark single as read on click
                                await fetch('?controller=notification&action=markRead', {
                                    method: 'POST',
                                    body: new URLSearchParams({
                                        id: n.id
                                    })
                                });
                                fetchCount();
                                li.style.opacity = 0.6;
                            };
                            listEl.appendChild(li);
                        });
                    } catch (e) {
                        console.error('notif list error', e);
                    }
                }

                bell.addEventListener('click', async (ev) => {
                    ev.preventDefault();
                    if (dropdown.style.display === 'none') {
                        await fetchList();
                        dropdown.style.display = 'block';
                    } else {
                        dropdown.style.display = 'none';
                    }
                });

                markAllBtn.addEventListener('click', async (ev) => {
                    ev.preventDefault();
                    await fetch('?controller=notification&action=markAllRead', {
                        method: 'POST'
                    });
                    await fetchCount();
                    // update list
                    await fetchList();
                });

                // initial
                fetchCount();
                setInterval(fetchCount, 15000);
            })();
        </script>
        <script>
            (function() {
                const container = document.querySelector('.falling-gifts');
                console.log('container:', container);

                const test = document.createElement('div');
                test.style.position = 'absolute';
                test.style.top = '20px';
                test.style.left = '20px';
                test.style.width = '50px';
                test.style.height = '50px';
                test.style.background = 'red';
                test.style.zIndex = '1';

                container.appendChild(test);
            })();
        </script>


    </div>
</header>