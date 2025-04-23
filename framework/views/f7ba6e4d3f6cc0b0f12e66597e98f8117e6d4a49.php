<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Profile</h2>

        <!-- Profile Display Section -->
        <div class="card mb-4" style="width: 18rem;">
            <img id="profileImage" src="default.jpg" class="card-img-top" alt="Profile Picture">
            <div class="card-body">
                <h5 class="card-title" id="userName">User Name</h5>
                <p class="card-text" id="userEmail">User Email</p>
                <p class="card-text" id="userPhone">User Phone</p>
                <p class="card-text" id="userAddress">User Address</p>
            </div>
        </div>

        <!-- Profile Picture Update Form -->
        <form id="profileUpdateForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profilePicture">Update Profile Picture</label>
                <input type="file" class="form-control-file" id="profilePicture" name="profile_picture" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile Picture</button>
        </form>
        
        <!-- Status Message -->
        <div id="statusMessage" class="mt-3"></div>
    </div>

    <script>
        // Fetch user profile data
        async function fetchProfile(userId) {
            try {
                const response = await fetch(`/api/profile_show/${userId}`);
                const data = await response.json();
                if (data.success) {
                    document.getElementById('userName').textContent = data.data.name;
                    document.getElementById('userEmail').textContent = data.data.email;
                    document.getElementById('userPhone').textContent = data.data.phone;
                    document.getElementById('userAddress').textContent = data.data.address;
                    document.getElementById('profileImage').src = data.data.profile_picture || 'default.jpg';
                } else {
                    document.getElementById('statusMessage').textContent = 'Profile not found';
                }
            } catch (error) {
                console.error('Error fetching profile:', error);
            }
        }

        // Update profile picture
        document.getElementById('profileUpdateForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await fetch(`/api/profile_update/${userId}`, {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.success) {
                    document.getElementById('statusMessage').textContent = 'Profile picture updated successfully!';
                    fetchProfile(userId); // Refresh profile data to show new picture
                } else {
                    document.getElementById('statusMessage').textContent = 'Error updating profile picture';
                }
            } catch (error) {
                console.error('Error updating profile picture:', error);
            }
        });

        // Initialize profile data (replace `userId` with the actual user ID)
        const userId = 1; // Example user ID
        fetchProfile(userId);
    </script>
</body>
</html>
<?php /**PATH C:\laravel\wood furniture\wood\resources\views\user\profile.blade.php ENDPATH**/ ?>