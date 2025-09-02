// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all nav links
            navLinks.forEach(l => l.classList.remove('active'));
            // Remove active class from all tab contents
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Show corresponding tab content
            const tabId = this.getAttribute('data-tab');
            const targetTab = document.getElementById(tabId);
            if (targetTab) {
                targetTab.classList.add('active');
            }
        });
    });
});

// Mobile sidebar toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('mobile-open');
}

// Order management functions
function startWrapping(orderId) {
    showNotification(`Started wrapping order ${orderId}`, 'success');
    updateOrderProgress(orderId, 25);
}

function continueWrapping(orderId) {
    showNotification(`Continuing work on order ${orderId}`, 'info');
}

function markComplete(orderId) {
    if (confirm(`Mark order ${orderId} as complete?`)) {
        showNotification(`Order ${orderId} marked as complete!`, 'success');
        updateOrderProgress(orderId, 100);
    }
}

function updateProgress(orderId) {
    const newProgress = prompt('Enter progress percentage (0-100):');
    if (newProgress && newProgress >= 0 && newProgress <= 100) {
        updateOrderProgress(orderId, newProgress);
        showNotification(`Progress updated to ${newProgress}%`, 'success');
    }
}

function updateOrderProgress(orderId, progress) {
    const progressBars = document.querySelectorAll('.progress-fill');
    const progressPercentages = document.querySelectorAll('.progress-percentage');
    
    // Update progress bars (simplified - in real app would target specific order)
    if (progressBars.length > 0) {
        progressBars[0].style.width = progress + '%';
    }
    if (progressPercentages.length > 0) {
        progressPercentages[0].textContent = progress + '%';
    }
}

function viewOrderDetails(orderId) {
    showNotification(`Viewing details for order ${orderId}`, 'info');
}

function contactCustomer(orderId) {
    showNotification(`Contacting customer for order ${orderId}`, 'info');
}

function requestExtension(orderId) {
    if (confirm('Request deadline extension for this order?')) {
        showNotification('Extension request sent to customer', 'success');
    }
}

// Filter functions
function filterOrders(status) {
    const orderCards = document.querySelectorAll('.order-card[data-status]');
    orderCards.forEach(card => {
        if (status === 'all' || card.getAttribute('data-status') === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterGallery(category) {
    const galleryItems = document.querySelectorAll('.gallery-item[data-category]');
    galleryItems.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Quick action functions
function createNewOrder() {
    showNotification('Opening new order form...', 'info');
}

function scanQRCode() {
    showNotification('QR code scanner activated', 'info');
}

function viewInventory() {
    showNotification('Opening inventory management...', 'info');
}

function generateReport() {
    showNotification('Generating business report...', 'info');
}

function refreshOrders() {
    showNotification('Refreshing order list...', 'info');
    // Add loading animation
    const refreshBtn = event.target;
    const originalText = refreshBtn.innerHTML;
    refreshBtn.innerHTML = '<div class="loading"></div> Refreshing...';
    
    setTimeout(() => {
        refreshBtn.innerHTML = originalText;
        showNotification('Orders refreshed successfully!', 'success');
    }, 2000);
}

// Service management functions
function addNewService() {
    showNotification('Opening new service form...', 'info');
}

function editService(serviceId) {
    showNotification(`Editing service: ${serviceId}`, 'info');
}

function viewServiceStats(serviceId) {
    showNotification(`Viewing statistics for: ${serviceId}`, 'info');
}

// Gallery functions
function uploadPhoto() {
    showNotification('Opening photo upload dialog...', 'info');
}

function editPhoto(photoId) {
    showNotification(`Editing photo ${photoId}`, 'info');
}

function deletePhoto(photoId) {
    if (confirm('Delete this photo from your gallery?')) {
        showNotification(`Photo ${photoId} deleted`, 'success');
    }
}

// Earnings functions
function exportPayments() {
    showNotification('Exporting payment history...', 'info');
}

function viewReceipt(orderId) {
    showNotification(`Viewing receipt for order ${orderId}`, 'info');
}

function followUpPayment(orderId) {
    showNotification(`Following up on payment for order ${orderId}`, 'info');
}

// Analytics functions
function changeAnalyticsPeriod(period) {
    showNotification(`Switching to ${period} view...`, 'info');
}

// Profile functions
function saveProfile() {
    showNotification('Profile saved successfully!', 'success');
}

function changeProfilePicture() {
    showNotification('Opening photo selector...', 'info');
}

function changePassword() {
    showNotification('Password changed...', 'info');
}

// Header functions
function showNotifications() {
    showNotification('Opening notifications panel...', 'info');
}

function showProfileMenu() {
    showNotification('Opening profile menu...', 'info');
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        showNotification('Logging out...', 'info');
        setTimeout(() => {
            window.location.href = '#';
        }, 1000);
    }
}

// Utility function for notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    `;
    
    switch(type) {
        case 'success':
            notification.style.background = 'linear-gradient(135deg, #4caf50, #66bb6a)';
            break;
        case 'error':
            notification.style.background = 'linear-gradient(135deg, #f44336, #ef5350)';
            break;
        case 'warning':
            notification.style.background = 'linear-gradient(135deg, #ff9800, #ffb74d)';
            break;
        default:
            notification.style.background = 'linear-gradient(135deg, #2196f3, #42a5f5)';
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    tooltipElements.forEach(element => {
        element.classList.add('tooltip');
    });
});

// Auto-refresh data every 30 seconds
setInterval(() => {
    // In a real application, this would fetch fresh data from the server
    console.log('Auto-refreshing dashboard data...');
}, 30000);