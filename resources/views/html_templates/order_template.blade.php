<!DOCTYPE html>
<html>
<head>
    <title>Order {{ $order_id }} - Mockup</title>
    <style>
       
      body {
        font-family: "Georgia", serif;
        margin: 0;
        padding: 0;
        background: white;
      }
      .container {
        width: 900px;
        margin: 0 auto;
        padding: 40px;
        color: #000;
      }
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .header h1 {
        font-size: 28px;
        font-weight: normal;
      }
      .header img {
        height: 60px;
      }
      hr {
        border: none;
        height: 2px;
        background: black;
        margin: 10px 0 30px;
      }
      .section-title {
        font-weight: bold;
        font-size: 18px;
      }
      .black-bar {
        background: black;
        color: #00b2e2;
        padding: 10px;
        border-radius: 20px;
        font-weight: bold;
        margin: 30px 0 10px;
      }
      .product-details,
      .design-details {
        display: flex;
        justify-content: space-between;
      }
      .product-text,
      .design-text {
        width: 65%;
      }
      .product-image,
      .mockup-image {
        width: 30%;
        text-align: center;
      }
      .product-image img,
      .mockup-image img {
        width: 100px;
      }
      .product-image p,
      .mockup-image p {
        font-size: 12px;
        margin-top: 5px;
      }
      .colors-artwork {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
      }
      .color-swatches img {
        height: 100px;
      }
      .art-dimensions {
        text-align: center;
        font-size: 12px;
      }
      .art-dimensions img {
        height: 80px;
      }
      .disclaimer {
        font-size: 14px;
        font-weight: bold;
        margin-top: 30px;
      }
      .approval-box {
        border: 2px solid black;
        margin-top: 30px;
        padding: 15px;
        font-size: 14px;
      }
      .approval-box .highlight {
        color: red;
        font-weight: bold;
      }
      .approval-buttons {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }
      .approval-buttons button {
        padding: 10px 30px;
        font-size: 16px;
        border: 2px solid black;
        margin: 0 20px;
        border-radius: 8px;
        cursor: pointer;
      }
      .approval-buttons .accept {
        background-color: #00c060;
        color: white;
        border-color: #00c060;
      }
       .approval-buttons .change {
        background-color: #ffffff;
        color: rgb(0, 0, 0);
        border-color: #000000;
      }
   
      .dropdown-section {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
      }
      .dropdown-section select,
      .dropdown-section textarea {
        padding: 8px;
        width: 250px;
        font-size: 14px;
      }
      .note {
        text-align: center;
        color: red;
        font-size: 12px;
        margin-top: 10px;
        font-weight: bold;
      }
      .footer-note {
        font-size: 13px;
        margin-top: 20px;
      }
      .terms-page {
        margin-top: 60px;
      }
      .terms-page h1 {
        font-weight: normal;
      }
      .terms-page .black-bar {
        background: black;
        color: #00b2e2;
        padding: 10px;
        border-radius: 20px;
        font-weight: bold;
        margin: 20px 0;
        display: inline-block;
      }
      .terms-page ul {
        margin-left: 20px;
        font-size: 15px;
        line-height: 1.6;
      }
      .terms-page ul li {
        margin-bottom: 8px;
      }
      .terms-page img {
        float: right;
        height: 60px;
      }
      .requestChangesBtn {
        display: none;
      }

      .placement-request-box {
        display: none;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 6px;
        background-color: #f9f9f9;
      }

      .placement-request-box strong {
        font-size: 16px;
        display: block;
        margin-bottom: 5px;
      }

      .placement-request-box textarea {
        width: 100%;
        height: 100px;
        padding: 8px;
        font-size: 14px;
        margin-bottom: 10px;
      }

      .submit-placement {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border: none;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
      }

         .button-container {
      display: flex;
      gap: 15px;
      margin-bottom: 10px;
    }

    button {
      padding: 10px 18px;
      font-size: 14px;
      cursor: pointer;
      border: none;
      background-color: #007bff;
      color: white;
      border-radius: 4px;
      transition: background-color 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    .box-container {
      position: relative;
    }

    .box {
      display: none;
      position: relative;
      padding: 15px;
      margin-top: 10px;
      background: #ffffff;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .box strong {
      font-size: 16px;
      display: block;
      margin-bottom: 8px;
    }

    .box p {
      margin-bottom: 10px;
      font-size: 14px;
      color: #333;
    }

    .box textarea {
      width: 100%;
      height: 100px;
      margin: 10px 0;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    .box img {
      max-width: 100%;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .submit {
      background-color: #28a745;
      color: white;
      padding: 8px 16px;
      border: none;
      font-size: 14px;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit:hover {
      background-color: #218838;
    }
  
    </style>
</head>
<body>
<!-- <div class="order-box">
    <h2>Order ID: {{ $order_id }}</h2>
    <p>Customer Name: {{ $data['customer']['first_name'] ?? '' }} {{ $data['customer']['last_name'] ?? '' }}</p>
    <p>Email: {{ $data['email'] ?? '' }}</p>
    <br>
    <h3>Items</h3>
    <table class="items-table">
        <thead>
        <tr><th>Product</th><th>Quantity</th><th>Price</th></tr>
        </thead>
        <tbody>
        @foreach($data['line_items'] as $item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['price'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div> -->


 <div class="container">
      <div class="header">
        <h1>VIRTUAL PROOF APPROVAL</h1>
        <img src="./Images/Y-Not_New-Logo-03 (003).png" alt="Y-Not Logo" />
      </div>
      <hr />
      <p><strong>Mockup Approval Required – Order ID: #{{ $order_id }}</strong></p>
      <p>Dear {{ $data['customer']['first_name'] ?? '' }} {{ $data['customer']['last_name'] ?? '' }},</p>
      <p>
          <!-- <p>Email: {{ $data['email'] ?? '' }}</p> -->
        Thank you for your order with Y-Not. Please find below the custom
        virtual proof created as per the submitted product and design details.
        Please check the following items in the attached document:
      </p>

      <!-- <div class="black-bar">Order Details</div> -->
      <div class="product-details">
        <div class="product-text">
          <ul>
            <li>Order ID</li>
            <li>Imprint Method</li>
            <li>Imprint Colors</li>
            <li>Logo Size</li>
            <li>Customized Product Image</li>
          </ul>
        </div>
        <div class="product-image">
          <!-- <img
            src="./Images/Screenshot 2025-07-30 210909.png"
            alt="Product Image"
          /> -->
          <!-- <p>Cotton Round Neck T-Shirt<br />Product Image</p> -->
        </div>
      </div>

      <div class="black-bar">Attached Document Viewer:</div>
      <!-- <iframe
        src="AD6357_PROOF_STARLINE.pdf"
        width="100%"
        height="800px"
        style="border: none"
      ></iframe> -->

      <!-- <iframe 
    src="{{ asset('storage/app/public/pdfs/' . $order_id . '.pdf') }}" 
    width="100%" 
    height="800px"
     style="border: none">
</iframe> -->

<iframe 
    src="{{ asset('storage/pdfs/' . $order_id . '.pdf') }}" 
    width="100%" 
    height="800px" 
    style="border: none;">
</iframe>


      <div class="disclaimer">
        Disclaimer: Please note that the color swatches displayed may vary
        slightly from the actual Pantone colors that will appear on the final
        printed product
      </div>

    <div class="approval-box">
      <p><span class="highlight">Imp:</span> <strong>Action Required</strong></p>
      <p>Please click on one of the following buttons to proceed:</p>
      <p><span class="highlight">Note:</span> Kindly go through the Terms and Conditions on Page 2 and take action accordingly</p>

      <div class="approval-buttons">
        <button class="accept">Accept</button>
        <button class="change" id="requestChangeBtn" type="button">Request for change *</button>
      </div>

      <!-- Request for Change Panel -->
      <div class="requestChangesBtn">
        <div class="dropdown-section">
          <button type="button" id="placementBtn">Placement Adjustments</button>
          <button type="button" id="colorBtn">Color Modifications</button>
        </div>

        <div class="box-container">
          <!-- Placement Box -->
          <div class="box" id="placementBox">
            <strong>Placement Adjustments Request</strong>
            <p>Please describe the placement change (e.g. move logo to left).</p>
            <textarea placeholder="Enter your comments here..."></textarea>
            <button class="submit-placement">Submit Changes</button>
          </div>

          <!-- Color Box -->
          <div class="box" id="colorBox">
            <strong>Color Modifications Request</strong>
            <p>Please describe the color change (e.g. red to blue).</p>
            <textarea placeholder="Enter your comments here..."></textarea>
            <button class="submit-placement">Submit Changes</button>
          </div>
        </div>
      </div>

      <div class="note">
*Kindly look into this if customer Request for changes we have to provide the two dropdowns such that if he chooses anyone he should get a text box to fill the request changes accordingly
      </div>
    </div>

      <div class="terms-page">
        <div class="header">
          <h1>MOCKUP APPROVAL</h1>
          <img src="./Images/Y-Not_New-Logo-03 (003).png" alt="Y-Not Logo" />
        </div>
        <hr />
        <div class="black-bar">
          Terms & Conditions for Mockup Revisions and Approval *
        </div>
        <li style="list-style-type: none">
          To ensure timely production and consistent quality, please review the
          following terms and conditions governing mockup approvals and revision
          requests:
        </li>
        <ul>
          <li>
            <strong>Allowed Revisions (Minor Adjustments Only)*:</strong>
            Customers may request changes limited to:
            <ul>
              <li>
                Placement Adjustments: Shifting the design location (e.g.,
                front, back, left chest).
              </li>
              <li>
                Color Modifications: Changes in the print/embroidery colors from
                the existing palette.
              </li>
            </ul>
          </li>
          <li>
            <strong>Not Permitted:</strong> The following revisions are not
            accepted once the mockup is generated:
            <ul>
              <li>
                Complete Design Replacement: Changing the original artwork or
                uploading a new design.
              </li>
              <li>
                Print Method Alteration: Switching between screen printing,
                embroidery, DTF, or other types after confirmation.
              </li>
              <li>
                Major Layout Changes: Requests that significantly alter the
                structure, style, or intent of the approved virtual proof.
              </li>
            </ul>
          </li>
          <li>
            <strong>Revision Cycle Policy</strong>
            <ul>
              <li>
                Only one revision cycle is included in the standard process.
              </li>
              <li>
                Any additional revisions are subject to approval, production
                delays, and may incur extra charges.
              </li>
            </ul>
          </li>
          <li>
            <strong>Response Timeframe</strong>
            <ul>
              <li>
                Customers are expected to respond within 24–48 hours of
                receiving the mockup.
              </li>
              <li>
                If no response is received within the specified time, the last
                shared version will be considered auto-approved to avoid
                production delays.
              </li>
            </ul>
          </li>
          <li>
            <strong>Note</strong>
            <ul>
              <li>
                Delayed responses or revision requests beyond the allowed scope
                can lead to missed delivery timelines.
              </li>
              <li>
                Y-Not B2B reserves the right to decline excessive changes or
                revisions that compromise production feasibility.
              </li>
            </ul>
          </li>
        </ul>
        <p>Thank you,<br />Y-Not Team</p>
      </div>
    </div>

<script>
    
  // Show/hide the overall request section
  document
    .getElementById("requestChangeBtn")
    .addEventListener("click", function () {
      const requestSection = document.querySelector(".requestChangesBtn");
      requestSection.style.display =
        requestSection.style.display === "none" || requestSection.style.display === ""
          ? "block"
          : "none";
    });

  // Toggle Placement Box (with label change and exclusive open)
  document
    .getElementById("placementBtn")
    .addEventListener("click", function () {
      const placementBox = document.getElementById("placementBox");
      const colorBox = document.getElementById("colorBox");

      const isOpening = placementBox.style.display !== "block";
      placementBox.style.display = isOpening ? "block" : "none";
      this.textContent = isOpening ? "Placement Adjustments:" : "Placement Adjustments";

      // Close the other box
      colorBox.style.display = "none";
      document.getElementById("colorBtn").textContent = "Color Modifications";
    });

  // Toggle Color Box (with label change and exclusive open)
  document
    .getElementById("colorBtn")
    .addEventListener("click", function () {
      const colorBox = document.getElementById("colorBox");
      const placementBox = document.getElementById("placementBox");

      const isOpening = colorBox.style.display !== "block";
      colorBox.style.display = isOpening ? "block" : "none";
      this.textContent = isOpening ? "Color Modifications:" : "Color Modifications";

      // Close the other box
      placementBox.style.display = "none";
      document.getElementById("placementBtn").textContent = "Placement Adjustments";
    });

</script>

</body>
</html>
