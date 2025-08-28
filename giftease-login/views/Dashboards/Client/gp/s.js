// ShopDash Navigation System
class DashboardNavigation {
  constructor() {
    this.currentSection = "browse"
    this.mobileMenuOpen = false
    this.theme = localStorage.getItem("theme") || "light"
    this.recentSections = JSON.parse(localStorage.getItem("recentSections")) || []
    this.userPreferences = JSON.parse(localStorage.getItem("userPreferences")) || {}
    this.cartItems = JSON.parse(localStorage.getItem("cartItems")) || []
    this.wishlistItems = JSON.parse(localStorage.getItem("wishlistItems")) || []
    this.isOffline = !navigator.onLine
    this.searchHistory = JSON.parse(localStorage.getItem("searchHistory")) || []
    this.shortcuts = {
      KeyB: "browse",
      KeyC: "cart",
      KeyW: "wishlist",
      KeyO: "orders",
      KeyH: "history",
      KeyP: "payments",
      KeyU: "customize",
      KeyA: "account",
      KeyS: "settings",
    }
    this.init()
  }

  init() {
    this.bindEvents()
    this.loadSection(this.currentSection)
    this.updateCartBadge()
    this.applyTheme()
    this.setupOfflineDetection()
    this.setupKeyboardShortcuts()
    this.setupAutoSave()
  }

  bindEvents() {
    // Navigation items
    document.querySelectorAll(".nav-item").forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault()
        const section = item.getAttribute("data-section")
        if (section) {
          this.navigateToSection(section)
        }
      })
    })

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector(".mobile-menu-btn")
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener("click", () => {
        this.toggleMobileMenu()
      })
    }

    // Search functionality
    const searchInput = document.getElementById("searchInput")
    if (searchInput) {
      searchInput.addEventListener("input", (e) => {
        this.handleSearch(e.target.value)
      })
    }

    // Close mobile menu when clicking outside
    document.addEventListener("click", (e) => {
      const sidebar = document.querySelector(".left_sidebar")
      const mobileMenuBtn = document.querySelector(".mobile-menu-btn")

      if (this.mobileMenuOpen && !sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        this.closeMobileMenu()
      }
    })

    // Handle window resize
    window.addEventListener("resize", () => {
      if (window.innerWidth > 768 && this.mobileMenuOpen) {
        this.closeMobileMenu()
      }
    })

    // Theme toggle event
    const themeToggle = document.querySelector(".theme-toggle")
    if (themeToggle) {
      themeToggle.addEventListener("click", () => {
        this.toggleTheme()
      })
    }

    // Advanced search with filters
    const searchFilters = document.querySelector(".search-filters")
    if (searchFilters) {
      searchFilters.addEventListener("change", (e) => {
        this.handleAdvancedSearch()
      })
    }

    // Drag and drop for cart items
    document.addEventListener("dragstart", this.handleDragStart.bind(this))
    document.addEventListener("dragover", this.handleDragOver.bind(this))
    document.addEventListener("drop", this.handleDrop.bind(this))
  }

  toggleTheme() {
    this.theme = this.theme === "light" ? "dark" : "light"
    localStorage.setItem("theme", this.theme)
    this.applyTheme()
    this.showNotification(`Switched to ${this.theme} mode`, "success")
  }

  applyTheme() {
    document.documentElement.setAttribute("data-theme", this.theme)
    const themeIcon = document.querySelector(".theme-toggle i")
    if (themeIcon) {
      themeIcon.className = this.theme === "light" ? "fas fa-moon" : "fas fa-sun"
    }
  }

  setupKeyboardShortcuts() {
    document.addEventListener("keydown", (e) => {
      if (e.ctrlKey || e.metaKey) {
        const section = this.shortcuts[e.code]
        if (section) {
          e.preventDefault()
          this.navigateToSection(section)
          this.showNotification(`Navigated to ${section} (Ctrl+${e.key.toUpperCase()})`, "info")
        }

        // Quick search shortcut
        if (e.code === "KeyF") {
          e.preventDefault()
          const searchInput = document.getElementById("searchInput")
          if (searchInput) {
            searchInput.focus()
            this.showNotification("Quick search activated (Ctrl+F)", "info")
          }
        }
      }
    })
  }

  setupOfflineDetection() {
    window.addEventListener("online", () => {
      this.isOffline = false
      this.showNotification("Connection restored", "success")
      this.syncOfflineData()
    })

    window.addEventListener("offline", () => {
      this.isOffline = true
      this.showNotification("You are offline. Changes will be saved locally.", "warning")
    })
  }

  setupAutoSave() {
    setInterval(() => {
      this.saveUserState()
    }, 30000) // Auto-save every 30 seconds
  }

  navigateToSection(sectionName) {
    // Update active navigation item
    document.querySelectorAll(".nav-item").forEach((item) => {
      item.classList.remove("active")
    })

    const activeItem = document.querySelector(`[data-section="${sectionName}"]`)
    if (activeItem) {
      activeItem.classList.add("active")
    }

    // Load section content
    this.loadSection(sectionName)
    this.currentSection = sectionName

    // Close mobile menu if open
    if (this.mobileMenuOpen) {
      this.closeMobileMenu()
    }

    // Update search placeholder
    this.updateSearchPlaceholder(sectionName)

    this.addToRecentSections(sectionName)
    this.updateBreadcrumbs(sectionName)
    this.trackUserActivity("navigation", sectionName)
  }

  addToRecentSections(section) {
    this.recentSections = this.recentSections.filter((s) => s !== section)
    this.recentSections.unshift(section)
    this.recentSections = this.recentSections.slice(0, 5)
    localStorage.setItem("recentSections", JSON.stringify(this.recentSections))
  }

  updateBreadcrumbs(section) {
    const breadcrumbContainer = document.querySelector(".breadcrumbs")
    if (breadcrumbContainer) {
      const sectionNames = {
        browse: "Browse Products",
        cart: "Shopping Cart",
        wishlist: "Wishlist",
        orders: "Track Orders",
        history: "Order History",
        payments: "Payment Methods",
        customize: "Customize Items",
        account: "Account Settings",
        settings: "Settings",
      }

      breadcrumbContainer.innerHTML = `
        <span class="breadcrumb-item">Dashboard</span>
        <i class="fas fa-chevron-right"></i>
        <span class="breadcrumb-item active">${sectionNames[section] || section}</span>
      `
    }
  }

  handleSearch(query) {
    if (!query.trim()) return

    // Add to search history
    if (!this.searchHistory.includes(query)) {
      this.searchHistory.unshift(query)
      this.searchHistory = this.searchHistory.slice(0, 10)
      localStorage.setItem("searchHistory", JSON.stringify(this.searchHistory))
    }

    this.trackUserActivity("search", query)
    this.showAdvancedSearchResults(query)
  }

  handleAdvancedSearch() {
    const searchInput = document.getElementById("searchInput")
    const priceFilter = document.querySelector('[name="price-filter"]')
    const categoryFilter = document.querySelector('[name="category-filter"]')
    const ratingFilter = document.querySelector('[name="rating-filter"]')

    const filters = {
      query: searchInput?.value || "",
      price: priceFilter?.value || "all",
      category: categoryFilter?.value || "all",
      rating: ratingFilter?.value || "all",
    }

    this.showAdvancedSearchResults(filters.query, filters)
  }

  showAdvancedSearchResults(query, filters = {}) {
    const content = document.querySelector(".content")
    if (!content) return

    content.innerHTML = `
      <div class="section-header">
        <h1>Search Results</h1>
        <p>Results for "${query}"</p>
        <div class="search-stats">
          <span>Found 42 results in 0.3s</span>
          ${this.isOffline ? '<span class="offline-badge">Offline Mode</span>' : ""}
        </div>
      </div>
      <div class="search-filters-bar">
        <select name="category-filter">
          <option value="all">All Categories</option>
          <option value="electronics">Electronics</option>
          <option value="clothing">Clothing</option>
          <option value="books">Books</option>
        </select>
        <select name="price-filter">
          <option value="all">Any Price</option>
          <option value="0-50">$0 - $50</option>
          <option value="50-200">$50 - $200</option>
          <option value="200+">$200+</option>
        </select>
        <select name="rating-filter">
          <option value="all">Any Rating</option>
          <option value="4+">4+ Stars</option>
          <option value="3+">3+ Stars</option>
        </select>
      </div>
      <div class="search-results">
        <div class="result-item" draggable="true" data-product="smartphone">
          <div class="result-image">📱</div>
          <div class="result-details">
            <h3>Premium Smartphone</h3>
            <p class="result-price">$699.99</p>
            <div class="result-rating">⭐⭐⭐⭐⭐ (4.8)</div>
          </div>
          <div class="result-actions">
            <button class="btn btn-sm" onclick="dashboard.addToWishlist('smartphone')">♡</button>
            <button class="btn btn-sm" onclick="dashboard.compareProduct('smartphone')">Compare</button>
            <button class="btn btn-primary" onclick="dashboard.addToCart('smartphone')">Add to Cart</button>
          </div>
        </div>
      </div>
    `
  }

  addToCart(productId, quantity = 1) {
    const existingItem = this.cartItems.find((item) => item.id === productId)

    if (existingItem) {
      existingItem.quantity += quantity
    } else {
      this.cartItems.push({
        id: productId,
        quantity: quantity,
        addedAt: new Date().toISOString(),
      })
    }

    localStorage.setItem("cartItems", JSON.stringify(this.cartItems))
    this.updateCartBadge()
    this.trackUserActivity("add_to_cart", productId)

    this.showAdvancedNotification(`${productId} added to cart!`, "success", [
      { text: "View Cart", action: () => this.navigateToSection("cart") },
      { text: "Continue Shopping", action: () => {} },
    ])
  }

  removeFromCart(productId) {
    console.log(`Removing ${productId} from cart`)
    this.cartItems = this.cartItems.filter((item) => item.id !== productId)
    localStorage.setItem("cartItems", JSON.stringify(this.cartItems))
    this.updateCartBadge()
    this.showNotification("Item removed from cart!", "info")
    this.trackUserActivity("remove_from_cart", productId)
  }

  addToWishlist(productId) {
    if (!this.wishlistItems.includes(productId)) {
      this.wishlistItems.push(productId)
      localStorage.setItem("wishlistItems", JSON.stringify(this.wishlistItems))
      this.showNotification("Added to wishlist!", "success")
      this.trackUserActivity("add_to_wishlist", productId)
    } else {
      this.showNotification("Item already in wishlist", "info")
    }
  }

  compareProduct(productId) {
    const compareList = JSON.parse(localStorage.getItem("compareList")) || []

    if (compareList.length >= 3) {
      this.showNotification("Maximum 3 products can be compared", "warning")
      return
    }

    if (!compareList.includes(productId)) {
      compareList.push(productId)
      localStorage.setItem("compareList", JSON.stringify(compareList))
      this.showNotification(`Added to comparison (${compareList.length}/3)`, "success")
    }
  }

  handleDragStart(e) {
    if (e.target.hasAttribute("draggable")) {
      e.dataTransfer.setData("text/plain", e.target.dataset.product)
      e.target.style.opacity = "0.5"
    }
  }

  handleDragOver(e) {
    e.preventDefault()
  }

  handleDrop(e) {
    e.preventDefault()
    const productId = e.dataTransfer.getData("text/plain")
    const dropZone = e.target.closest(".drop-zone")

    if (dropZone && productId) {
      if (dropZone.classList.contains("cart-drop-zone")) {
        this.addToCart(productId)
      } else if (dropZone.classList.contains("wishlist-drop-zone")) {
        this.addToWishlist(productId)
      }
    }

    // Reset opacity
    document.querySelectorAll('[draggable="true"]').forEach((el) => {
      el.style.opacity = "1"
    })
  }

  trackUserActivity(action, data) {
    const activity = {
      action,
      data,
      timestamp: new Date().toISOString(),
      section: this.currentSection,
    }

    let activities = JSON.parse(localStorage.getItem("userActivities")) || []
    activities.unshift(activity)
    activities = activities.slice(0, 100) // Keep last 100 activities

    localStorage.setItem("userActivities", JSON.stringify(activities))
  }

  exportUserData() {
    const userData = {
      preferences: this.userPreferences,
      cartItems: this.cartItems,
      wishlistItems: this.wishlistItems,
      searchHistory: this.searchHistory,
      recentSections: this.recentSections,
      activities: JSON.parse(localStorage.getItem("userActivities")) || [],
      exportDate: new Date().toISOString(),
    }

    const dataStr = JSON.stringify(userData, null, 2)
    const dataBlob = new Blob([dataStr], { type: "application/json" })
    const url = URL.createObjectURL(dataBlob)

    const link = document.createElement("a")
    link.href = url
    link.download = `shopdash-data-${new Date().toISOString().split("T")[0]}.json`
    link.click()

    URL.revokeObjectURL(url)
    this.showNotification("Data exported successfully!", "success")
  }

  showAdvancedNotification(message, type = "info", actions = []) {
    const notification = document.createElement("div")
    notification.className = `notification notification-${type} advanced-notification`

    notification.innerHTML = `
      <div class="notification-content">
        <span class="notification-message">${message}</span>
        ${
          actions.length > 0
            ? `
          <div class="notification-actions">
            ${actions
              .map(
                (action) => `
              <button class="notification-btn" data-action="${action.text}">
                ${action.text}
              </button>
            `,
              )
              .join("")}
          </div>
        `
            : ""
        }
      </div>
      <button class="notification-close">×</button>
    `

    // Style the notification
    Object.assign(notification.style, {
      position: "fixed",
      top: "20px",
      right: "20px",
      minWidth: "300px",
      padding: "16px",
      borderRadius: "12px",
      color: "white",
      backgroundColor:
        type === "success" ? "#10b981" : type === "error" ? "#ef4444" : type === "warning" ? "#f59e0b" : "#3b82f6",
      zIndex: "9999",
      boxShadow: "0 8px 32px rgba(0,0,0,0.2)",
      transform: "translateX(100%)",
      transition: "all 0.3s ease",
    })

    document.body.appendChild(notification)

    // Bind action buttons
    actions.forEach((action, index) => {
      const btn = notification.querySelector(`[data-action="${action.text}"]`)
      if (btn) {
        btn.addEventListener("click", () => {
          action.action()
          this.removeNotification(notification)
        })
      }
    })

    // Close button
    const closeBtn = notification.querySelector(".notification-close")
    closeBtn.addEventListener("click", () => {
      this.removeNotification(notification)
    })

    // Animate in
    setTimeout(() => {
      notification.style.transform = "translateX(0)"
    }, 100)

    // Auto-remove after 5 seconds if no actions
    if (actions.length === 0) {
      setTimeout(() => {
        this.removeNotification(notification)
      }, 5000)
    }
  }

  removeNotification(notification) {
    notification.style.transform = "translateX(100%)"
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification)
      }
    }, 300)
  }

  syncOfflineData() {
    const offlineActions = JSON.parse(localStorage.getItem("offlineActions")) || []

    if (offlineActions.length > 0) {
      this.showNotification(`Syncing ${offlineActions.length} offline actions...`, "info")

      // Simulate API sync
      setTimeout(() => {
        localStorage.removeItem("offlineActions")
        this.showNotification("Offline data synced successfully!", "success")
      }, 2000)
    }
  }

  saveUserState() {
    const state = {
      currentSection: this.currentSection,
      theme: this.theme,
      cartItems: this.cartItems,
      wishlistItems: this.wishlistItems,
      lastSaved: new Date().toISOString(),
    }

    localStorage.setItem("userState", JSON.stringify(state))
  }

  showQuickActions() {
    const quickActions = document.createElement("div")
    quickActions.className = "quick-actions-menu"
    quickActions.innerHTML = `
      <div class="quick-action" onclick="dashboard.navigateToSection('cart')">
        <i class="fas fa-shopping-cart"></i>
        <span>Cart (${this.cartItems.length})</span>
      </div>
      <div class="quick-action" onclick="dashboard.navigateToSection('wishlist')">
        <i class="fas fa-heart"></i>
        <span>Wishlist (${this.wishlistItems.length})</span>
      </div>
      <div class="quick-action" onclick="dashboard.exportUserData()">
        <i class="fas fa-download"></i>
        <span>Export Data</span>
      </div>
      <div class="quick-action" onclick="dashboard.toggleTheme()">
        <i class="fas fa-palette"></i>
        <span>Toggle Theme</span>
      </div>
    `

    document.body.appendChild(quickActions)

    // Position near cursor or center
    Object.assign(quickActions.style, {
      position: "fixed",
      top: "50%",
      left: "50%",
      transform: "translate(-50%, -50%)",
      background: "white",
      borderRadius: "12px",
      boxShadow: "0 8px 32px rgba(0,0,0,0.2)",
      padding: "16px",
      zIndex: "10000",
    })

    // Close on outside click
    setTimeout(() => {
      document.addEventListener("click", function closeQuickActions(e) {
        if (!quickActions.contains(e.target)) {
          quickActions.remove()
          document.removeEventListener("click", closeQuickActions)
        }
      })
    }, 100)
  }

  loadSection(sectionName) {
    const content = document.querySelector(".content")
    if (!content) return

    // Clear current content
    content.innerHTML = ""

    // Load section-specific content
    switch (sectionName) {
      case "browse":
        this.loadBrowseSection(content)
        break
      case "cart":
        this.loadCartSection(content)
        break
      case "wishlist":
        this.loadWishlistSection(content)
        break
      case "orders":
        this.loadOrdersSection(content)
        break
      case "history":
        this.loadHistorySection(content)
        break
      case "payments":
        this.loadPaymentsSection(content)
        break
      case "customize":
        this.loadCustomizeSection(content)
        break
      case "account":
        this.loadAccountSection(content)
        break
      case "settings":
        this.loadSettingsSection(content)
        break
      default:
        this.loadBrowseSection(content)
    }
  }

  loadBrowseSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Browse Products</h1>
                <p>Discover amazing products in our catalog</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Products</span>
                        <i class="fas fa-box stat-icon"></i>
                    </div>
                    <div class="stat-value">1,247</div>
                    <div class="stat-change">+12% from last month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Categories</span>
                        <i class="fas fa-tags stat-icon"></i>
                    </div>
                    <div class="stat-value">24</div>
                    <div class="stat-change">New arrivals weekly</div>
                </div>
            </div>
            <div class="products-grid">
                <div class="product-card" draggable="true" data-product="smartphone">
                    <div class="product-image">📱</div>
                    <h3>Smartphone</h3>
                    <p class="product-price">$599.99</p>
                    <button class="btn btn-primary" onclick="dashboard.addToCart('smartphone')">Add to Cart</button>
                </div>
                <div class="product-card" draggable="true" data-product="laptop">
                    <div class="product-image">💻</div>
                    <h3>Laptop</h3>
                    <p class="product-price">$999.99</p>
                    <button class="btn btn-primary" onclick="dashboard.addToCart('laptop')">Add to Cart</button>
                </div>
            </div>
        `
  }

  loadCartSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Shopping Cart</h1>
                <p>Review your selected items</p>
            </div>
            <div class="cart-items">
                <div class="cart-item">
                    <span class="item-name">Smartphone</span>
                    <span class="item-price">$599.99</span>
                    <button class="btn btn-danger" onclick="dashboard.removeFromCart('smartphone')">Remove</button>
                </div>
                <div class="cart-total">
                    <strong>Total: $599.99</strong>
                </div>
                <button class="btn btn-primary">Proceed to Checkout</button>
            </div>
            <div class="drop-zone cart-drop-zone">
                <h2>Drag items here to add to cart</h2>
            </div>
        `
  }

  loadWishlistSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Wishlist</h1>
                <p>Items you want to buy later</p>
            </div>
            <div class="wishlist-items">
                <p>Your wishlist is empty. Start browsing to add items!</p>
            </div>
            <div class="drop-zone wishlist-drop-zone">
                <h2>Drag items here to add to wishlist</h2>
            </div>
        `
  }

  loadOrdersSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Track Orders</h1>
                <p>Monitor your current orders</p>
            </div>
            <div class="orders-list">
                <div class="order-item">
                    <span class="order-id">#12345</span>
                    <span class="order-status">In Transit</span>
                    <span class="order-date">Dec 8, 2024</span>
                </div>
            </div>
        `
  }

  loadHistorySection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Order History</h1>
                <p>View your past purchases</p>
            </div>
            <div class="history-list">
                <p>No previous orders found.</p>
            </div>
        `
  }

  loadPaymentsSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Payment Methods</h1>
                <p>Manage your payment options</p>
            </div>
            <div class="payment-methods">
                <div class="payment-card">
                    <i class="fab fa-cc-visa"></i>
                    <span>**** **** **** 1234</span>
                    <button class="btn">Edit</button>
                </div>
            </div>
        `
  }

  loadCustomizeSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Customize Items</h1>
                <p>Personalize your products</p>
            </div>
            <div class="customize-options">
                <p>Select a product to customize</p>
            </div>
        `
  }

  loadAccountSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Account Settings</h1>
                <p>Manage your profile information</p>
            </div>
            <div class="account-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="Dilma" class="form-input">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="dilma@example.com" class="form-input">
                </div>
                <button class="btn btn-primary">Save Changes</button>
            </div>
        `
  }

  loadSettingsSection(container) {
    container.innerHTML = `
            <div class="section-header">
                <h1>Settings</h1>
                <p>Configure your preferences</p>
            </div>
            <div class="settings-options">
                <div class="setting-item">
                    <label>Email Notifications</label>
                    <input type="checkbox" checked>
                </div>
                <div class="setting-item">
                    <label>Dark Mode</label>
                    <input type="checkbox">
                </div>
            </div>
        `
  }

  toggleMobileMenu() {
    const sidebar = document.querySelector(".left_sidebar")
    if (sidebar) {
      sidebar.classList.toggle("mobile-open")
      this.mobileMenuOpen = !this.mobileMenuOpen
    }
  }

  closeMobileMenu() {
    const sidebar = document.querySelector(".left_sidebar")
    if (sidebar) {
      sidebar.classList.remove("mobile-open")
      this.mobileMenuOpen = false
    }
  }

  updateSearchPlaceholder(sectionName) {
    const searchInput = document.getElementById("searchInput")
    if (searchInput) {
      const placeholders = {
        browse: "Search products...",
        cart: "Search cart items...",
        wishlist: "Search wishlist...",
        orders: "Search orders...",
        history: "Search order history...",
        payments: "Search payment methods...",
        customize: "Search customizable items...",
        account: "Search account settings...",
        settings: "Search settings...",
      }
      searchInput.placeholder = placeholders[sectionName] || "Search..."
    }
  }

  updateCartBadge() {
    const cartBadge = document.querySelector(".cart-badge")
    if (cartBadge) {
      // This would typically get the actual cart count from your data
      const cartCount = this.cartItems.reduce((total, item) => total + item.quantity, 0) // Placeholder
      cartBadge.textContent = cartCount
    }
  }

  showNotification(message, type = "info") {
    // Create notification element
    const notification = document.createElement("div")
    notification.className = `notification notification-${type}`
    notification.textContent = message

    // Style the notification
    Object.assign(notification.style, {
      position: "fixed",
      top: "20px",
      right: "20px",
      padding: "12px 20px",
      borderRadius: "8px",
      color: "white",
      backgroundColor: type === "success" ? "#10b981" : type === "error" ? "#ef4444" : "#3b82f6",
      zIndex: "9999",
      boxShadow: "0 4px 12px rgba(0,0,0,0.15)",
      transform: "translateX(100%)",
      transition: "transform 0.3s ease",
    })

    document.body.appendChild(notification)

    // Animate in
    setTimeout(() => {
      notification.style.transform = "translateX(0)"
    }, 100)

    // Remove after 3 seconds
    setTimeout(() => {
      notification.style.transform = "translateX(100%)"
      setTimeout(() => {
        if (notification.parentNode) {
          notification.parentNode.removeChild(notification)
        }
      }, 300)
    }, 3000)
  }
}

// Global functions for backward compatibility
function toggleMobileMenu() {
  if (window.dashboard) {
    window.dashboard.toggleMobileMenu()
  }
}

function handleSearch() {
  const searchInput = document.getElementById("searchInput")
  if (window.dashboard && searchInput) {
    window.dashboard.handleSearch(searchInput.value)
  }
}

function navigateToSection(section) {
  if (window.dashboard) {
    window.dashboard.navigateToSection(section)
  }
}

function showNotification(message, type) {
  if (window.dashboard) {
    window.dashboard.showNotification(message, type)
  }
}

// Initialize dashboard when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  window.dashboard = new DashboardNavigation()
})

document.addEventListener("keydown", (e) => {
  if (e.ctrlKey && e.shiftKey && e.code === "Space") {
    e.preventDefault()
    if (window.dashboard) {
      window.dashboard.showQuickActions()
    }
  }
})
