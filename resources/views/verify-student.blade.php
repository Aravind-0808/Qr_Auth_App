<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
    #popup {
        position: fixed;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        /* or a specific width like 300px */
        height: auto;
        /* Adjust as needed */
        padding: 20px;
        text-align: center;
        background: rgb(233, 233, 233);
        max-width: 50%;
        min-width: 300px;

    }

    i {
        color: green;
        font-size: 100px;
        margin: 20px 0px
    }

    .box h1 {
        font-size: 30px;
        margin: 20px 0px
    }

    .box button {
        color: black;
        text-decoration: underline;
        cursor: pointer;
        margin-top: 20px;
        font-size: 20px;
    }

    .text {
        font-size: 50px;
        text-align: center;
        margin: 30px 0px
    }

    @media (max-width: 768px) {
        .text {
            font-size: 25px;
            text-align: center;
            margin: 30px 0px
        }
    }
</style>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Verify Student') }}
    </h2>
</x-slot>

<div class="">
    <h2 class="text">Scan the QR Code</h2>
    <div class="">
        <div style="display: flex; justify-content: center;">
            <div class="">

                <!-- QR Code Scanner Section -->
                <div id="qr-reader" class="mx-auto mt-8" style="width: 400px; height: 310px;"></div>

                <!-- Verification Result -->
                <div id="result" class="mt-4 text-center text-lg font-semibold text-green-500 hidden">
                    Student verified successfully!
                </div>
                <div id="error" class="mt-4 text-center text-lg font-semibold text-red-500 hidden">
                    Invalid student ID. Please try again.
                </div>

                <!-- Success Popup -->
                <div id="popup" class="hidden">
                    <div class="box">
                        <h1>Student Verified</h1>
                        <span><i class="fa-regular fa-circle-check"></i></span> <br>
                        <p id="current-date"></p>
                        <button onclick="closePopup()">close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load QR Code Scanner Script -->
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

<script>
    // Get the current date
    const today = new Date();

    // Format the date as dd mm yyyy
    const formattedDate = `${today.getDate().toString().padStart(2, '0')} ${(
  today.getMonth() + 1
).toString().padStart(2, '0')} ${today.getFullYear()}`;

    // Display the formatted date in the paragraph with id="current-date"
    document.getElementById("current-date").textContent = formattedDate;
    let qrReader = null; // Declare the qrReader variable globally so we can stop it

    // Ensure Html5Qrcode is available
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Html5Qrcode !== "undefined") {
            // Initialize the QR scanner
            qrReader = new Html5Qrcode("qr-reader");

            // Start scanning the QR code using the camera
            qrReader.start({
                    facingMode: "environment"
                }, // Use the back camera for scanning
                {
                    fps: 10, // Frames per second for scanning
                    qrbox: 250, // QR code scanning box size
                },
                (decodedText) => {
                    // Once a QR code is detected, parse the JSON data
                    try {
                        const qrData = JSON.parse(decodedText); // Parse JSON data from the QR code
                        if (qrData && qrData.id) {
                            verifyStudent(qrData.id); // Verify the student with the ID from the QR code
                        }
                    } catch (error) {
                        console.log("Invalid QR code data:", error);
                        showError("Invalid QR code. Please try again.");
                    }
                },
                (error) => {
                    console.log(`Error scanning QR code: ${error}`);
                }
            );
        } else {
            console.error("Html5Qrcode is not loaded. Please check the script source.");
        }
    });

    // Function to verify the student by sending the ID to the backend
    function verifyStudent(studentId) {
        // Send the student ID to the backend via AJAX
        fetch('/verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .content, // CSRF token for security
                },
                body: JSON.stringify({
                    id: studentId
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                // Show success or error message based on verification result
                if (data.success) {
                    // Stop the camera when the student is successfully verified
                    qrReader.stop();
                    showSuccess("Student verified successfully!");
                    showPopup(data.data); // Show the student details in the popup
                } else {
                    // Handle error cases
                    if (data.student_busno) {
                        showError(
                            `Invaild Yourbusno: ${data.student_busno}.`
                        );
                    } else {
                        showError("Invalid student ID. Please try again.");
                    }
                }
            })
            .catch((error) => {
                console.error('Error verifying student:', error);
                showError("An error occurred while verifying the student.");
            });
    }

    // Function to show success message
    function showSuccess(message) {
        document.getElementById('result').textContent = message;
        document.getElementById('result').classList.remove('hidden');
        document.getElementById('error').classList.add('hidden');
    }

    // Function to show error message
    function showError(message) {
        document.getElementById('error').textContent = message;
        document.getElementById('error').classList.remove('hidden');
        document.getElementById('result').classList.add('hidden');
    }

    // Function to show the success popup with student details
    function showPopup(studentData) {
        document.getElementById('popup').classList.remove('hidden');
    }
    // Function to close the popup
    function closePopup() {
        document.getElementById('popup').classList.add('hidden');
    }
</script>
