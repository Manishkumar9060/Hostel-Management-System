
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Room Allocation</title>
    <style>
        body {
            background-image: url("https://www.mmumullana.org/wp-content/uploads/2019/05/placement-bg.jpg");
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #1a11117a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            color:white;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        h3{
            color: white;
        }
    </style>
</head>
<body>
        <!-- <a href="">Home</a> -->
    <div class="container">
        <img src="image.png">
        <h2>Allotment of Room in Hostel</h2>
        <form id="allocationForm">
            <label for="name"><h3>Student Name:</h3></label>
            <input type="text" id="name" name="name" required>

            <label for="hostel_number"><h3>Hostel Number:</h3></label>
            <select id="hostel_number" name="hostel_number" required>
                <option value="1">Hostel 1</option>
                <option value="2">Hostel 2</option>
                <option value="3">Hostel 3</option>
                <option value="4">Hostel 4</option>
                <option value="5">Hostel 5</option>
                <option value="6">Hostel 6</option>
                <option value="7">Hostel 7</option>
                <option value="8">Hostel 8</option>
                <option value="9">Hostel 9</option>
                <option value="10">Hostel 10</option>
                <option value="11">Hostel 11</option>
                <option value="12">Hostel 12</option>
                <option value="13">Hostel 13</option>
                <option value="14">Hostel 14</option>
                <option value="15">Hostel 15</option>
                <option value="16">Hostel 16</option>
            </select>

            <label for="room_type"><h3>Room Type:</h3></label>
            <select id="room_type" name="room_type" required>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
            </select>

            <label for="room_number"><h3>Room Number:</h3></label>
            <input type="text" id="room_number" name="room_number" required>

            <button type="button" id="checkAvailabilityBtn">Check Availability</button>
            <button type="submit" id="allocateBtn" style="display:none;">Allocate Room</button>
        </form>

        <div id="message"></div>
    </div>

    <script>
       
        document.getElementById('checkAvailabilityBtn').addEventListener('click', function() {
            let hostel_number = document.getElementById('hostel_number').value;
            let room_type = document.getElementById('room_type').value;
            let room_number = document.getElementById('room_number').value;

            let messageDiv = document.getElementById('message');
            
           
            fetch('check_availability.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'hostel_number': hostel_number,
                    'room_type': room_type,
                    'room_number': room_number
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    
                    messageDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                    
                    document.getElementById('allocateBtn').style.display = 'block';
                } else {

                    messageDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
                    document.getElementById('allocateBtn').style.display = 'none';
                }
            })
            .catch(error => {
                messageDiv.innerHTML = `<p style="color: red;">Error: ${error}</p>`;
            });
        });


        document.getElementById('allocationForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            let formData = new FormData(this);
            let messageDiv = document.getElementById('message');
            

            fetch('allocate.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    
                    messageDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                    document.getElementById('allocationForm').reset();
                    document.getElementById('allocateBtn').style.display = 'none'; // Hide "Allocate" button
                } else {

                    messageDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
                }
            })
            .catch(error => {
                messageDiv.innerHTML = `<p style="color: red;">Error: ${error}</p>`;
            });
        });
    </script>

</body>
</html>


