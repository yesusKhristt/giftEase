<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'proof';
    include 'views/commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Upload Proof</h1>
        <p class="subtitle">Upload delivery confirmation photos and documents for completed deliveries.</p>
      </div>

      <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()">
        <i class="fas fa-cloud-upload-alt" style="font-size: 3rem; color: #3498db; margin-bottom: 15px;"></i>
        <h4>Drop files here or click to upload</h4>
        <p>Supported formats: JPG, PNG, PDF (Max 10MB)</p>
        <input type="file" id="fileInput" multiple accept="image/*,.pdf" style="display: none;"
          onchange="handleFileUpload(event)" />
      </div>

      <div class="card" id="proofGallery">
        <div class="summary-grid">
          <div class="card">
            <i class="fas fa-image" style="font-size: 2rem;"></i>
          </div>
          <div >
            <div style="font-weight: 600; margin-bottom: 5px;">DEL-001 Delivery</div>
            <div style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">Uploaded: 2 hours ago</div>
            <button class="btn2" onclick="viewProof('DEL-001')">View</button>
          </div>
        </div>

        <div class="summary-grid">
          <div class="card">
            <i class="fas fa-file-pdf" style="font-size: 2rem; color: #e74c3c;"></i>
          </div>
          <div>
            <div style="font-weight: 600; margin-bottom: 5px;">DEL-002 Receipt</div>
            <div style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">Uploaded: 1 hour ago</div>
            <button class="btn2" onclick="viewProof('DEL-002')">View</button>
          </div>
        </div>
      </div>
     
      <button class="btn1" style="margin-top: 10px;" onclick="reportIssue()">Report Issue</button>
      <table class="table">
        <thead>
          <tr>
        <th>Order ID</th>
        <th>Issue Description</th>
        <!-- <th>Status</th> -->
        <th>Reported On</th>
        <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
        <td>DEL-003</td>
        <td>Customer not in address and can't contact.</td>
        <!-- <td><span class="status pending">Pending</span></td> -->
        <td>2024-06-10</td>
        <td>
          <div style="display:inline-flex; gap:8px; align-items:center;">
            <button class="btn1" onclick="updateIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn1" onclick="deleteIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </td>
          </tr>
          <tr>
        <td>DEL-004</td>
        <td>Given Wrong Address.</td>
        <!-- <td><span class="status resolved">Resolved</span></td> -->
        <td>2024-06-08</td>
        <td>
          <div style="display:inline-flex; gap:8px; align-items:center;">
            <button class="btn1" onclick="updateIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn1" onclick="deleteIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </td>
          </tr>
          <tr>
        <td>DEL-005</td>
        <td>Customer don't pay.</td>
        <!-- <td><span class="status resolved">Resolved</span></td> -->
        <td>2024-06-09</td>
        <td>
          
          <div style="display:inline-flex; gap:8px; align-items:center;">
            <button class="btn1" onclick="updateIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn1" onclick="deleteIssue('DEL-003')" style="display:inline-flex; align-items:center;">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </td>
          </tr>
        </tbody>
      </table>

      

</body>

</html>