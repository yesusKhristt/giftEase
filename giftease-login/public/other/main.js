console.log("✓ main.js loaded");

document.addEventListener("DOMContentLoaded", () => {

    // 🎁 Gift animation (safe)
    const giftLayer = document.querySelector(".gift-fall-layer");
    if (giftLayer) {
        const gifts = ["🎁", "🎀", "🎉", "🍫", "💐"];
        setInterval(() => {
            const gift = document.createElement("span");
            gift.className = "gift-emoji";
            gift.innerText = gifts[Math.floor(Math.random() * gifts.length)];
            gift.style.left = Math.random() * 100 + "%";
            gift.style.fontSize = Math.random() * 12 + 18 + "px";
            gift.style.animationDuration = Math.random() * 10 + 10 + "s";
            giftLayer.appendChild(gift);
            setTimeout(() => gift.remove(), 4000);
        }, 100);
    }
});


const searchInput = document.querySelector(".search-input");

if (searchInput) {
  searchInput.addEventListener("keyup", function () {
    const filter = this.value.toLowerCase().trim();

    clearHighlights();
    if (!filter) return;

    const matches = highlightMatches(document.body, filter);

    // Auto-scroll to first match
    if (matches.length > 0) {
      matches[0].scrollIntoView({
        behavior: "smooth",
        block: "center"
      });
    }
  });
}

function clearHighlights() {
  document.querySelectorAll("span[data-highlight]").forEach(span => {
    const parent = span.parentNode;
    parent.replaceChild(document.createTextNode(span.textContent), span);
    parent.normalize();
  });
}

function highlightMatches(root, filter) {
  const walker = document.createTreeWalker(
    root,
    NodeFilter.SHOW_TEXT,
    null,
    false
  );

  let node;
  const matches = [];

  while ((node = walker.nextNode())) {
    const text = node.nodeValue;
    const lower = text.toLowerCase();
    const index = lower.indexOf(filter);

    if (index === -1) continue;

    const before = text.slice(0, index);
    const match = text.slice(index, index + filter.length);
    const after = text.slice(index + filter.length);

    const span = document.createElement("span");
    span.textContent = match;
    span.style.background = "rgba(233,30,99,0.5)";
    span.style.fontWeight = "700";
    span.setAttribute("data-highlight", "true");

    const parent = node.parentNode;
    parent.insertBefore(document.createTextNode(before), node);
    parent.insertBefore(span, node);
    parent.insertBefore(document.createTextNode(after), node);
    parent.removeChild(node);

    matches.push(span);
  }

  return matches;
}







function acceptOrder(orderId) {
    Swal.fire({
        title: 'Order Accepted!',
        text: `You have accepted order ${orderId}.`,
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

function markAllRead() {
    Swal.fire({
        title: 'Marked as Read',
        text: 'All notifications marked as read.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

function clearNotifications() {
    Swal.fire({
        title: 'Notifications Cleared',
        text: 'All notifications cleared.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

function startDelivery(orderId) {
    Swal.fire({
        title: 'Delivery Started!',
        text: 'Order ' + orderId + ' is on the way.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}

function markDelivered(orderId) {
    Swal.fire({
        title: 'Delivered!',
        text: 'Order ' + orderId + ' delivered successfully.',
        icon: 'success',
        confirmButtonText: 'Great!'
    });
}

