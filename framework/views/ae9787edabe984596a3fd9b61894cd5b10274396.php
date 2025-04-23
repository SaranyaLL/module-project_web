    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{
                background:#3B5D50;
            }
            .profile-card {
                max-width: 350px;
                margin: auto;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                overflow: hidden;
            }
            .profile-card img {
                width: 100%;
                height: auto;
                border-bottom: 1px solid #ddd;
            }
            .profile-card .card-body {
                padding: 20px;
            }
            .profile-card h5, .profile-card p {
                margin: 0;
                color: #555;
            }
            .profile-card p {
                font-size: 0.9rem;
                color: #777;
            }
            .status-message {
                font-size: 0.9rem;
                color: green;
                margin-top: 10px;
            }
        

        </style>
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center mb-1">User Profile</h2>

            <div class="text-left mb-3">
                <button onclick="window.history.back()" class="btn btn-secondary">Back</button>
            </div>

            <!-- Profile Display Section -->
            <div class="profile-card card">
            <img id="profileImage"src="<?php echo e($user->profile_picture ? asset('storage/' . $user->profile_picture) : 'images\user photo.jpg'); ?>" alt="Profile Picture">
            
                <div class="card-body text-center">
                    <h5><?php echo e($user->name); ?></h5>
                    <p><?php echo e($user->email); ?></p>
                    <p><?php echo e($user->phone); ?></p>
                    <p><?php echo e($user->address); ?></p>
                </div>
            </div>

         <!-- Profile Picture Update Form -->
<form id="profileUpdateForm" class="text-center mt-4 d-flex flex-column align-items-center" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="form-group text-center ml-3"> <!-- Added 'ml-3' for right shift -->
        <label for="profilePicture">Update Profile Picture</label>
        <input type="file" class="form-control-file mt-2" id="profilePicture" name="profile_picture" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update Profile Picture</button>
</form>




            <!-- Status Message -->
            <div id="statusMessage" class="status-message text-center"></div>
        </div>

        <script>
            document.getElementById("profileUpdateForm").addEventListener("submit", function (event) {
                event.preventDefault();
                
                const formData = new FormData(this);

                fetch('<?php echo e(route('profile.update')); ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('statusMessage').textContent = data.message;
                    if (data.success) {
                        document.getElementById("profileImage").src = data.profile_picture_url;
                    }
                })
                .catch(error => console.error('Error updating profile picture:', error));
            });
        </script>
    </body>
    </html>
<?php /**PATH C:\laravel\wood furniture\wood\resources\views/user/profile.blade.php ENDPATH**/ ?>