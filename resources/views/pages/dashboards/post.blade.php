<x-default-layout>
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        .custom-label {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .form-check-label {
            font-size: 15px;
        }
    </style>
    @section('title')
        Post-Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('post') }}
    @endsection

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="card-title">Send a Post</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="postTextarea" class="custom-label">Post Text</label>
                    <textarea class="form-control" id="postTextarea" name="post" placeholder="Enter Post text"></textarea>
                </div>


                <div class="form-group mt-4">
                    <div class="row mt-4">
                        <label for="social-networks" class="custom-label">Social Networks</label>

                        <div class="col-md-3">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input platform" type="checkbox" value="facebook"
                                    id="facebook" />
                                <label class="form-check-label text-dark" for="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input platform" type="checkbox" value="telegram"
                                    id="telegram" />
                                <label class="form-check-label text-dark" for="telegram">
                                    <i class="fab fa-telegram"></i> Telegram
                                </label>
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input platform" type="checkbox" value="twitter"
                                    id="twitter" />
                                <label class="form-check-label text-dark" for="twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </label>
                            </div>
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input platform" type="checkbox" value="linkedin"
                                    id="linkedin" />
                                <label class="form-check-label text-dark" for="linkedin">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-primary" id="getDataButton">
                        Post
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!--end::Row-->


    <div class="row g-5 g-xl-10 mb-5 mb-xl-10" style="margin-top: 20px; display:none;" id="responseDiv">
        <div class="card shadow-sm">
            <div id="responseContainer" class="mt-4"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function getPostData() {
            // Get the post text from the textarea
            var postText = $("#postTextarea").val().trim();

            // Initialize an empty platforms array
            var platforms = [];

            // Loop through each platform checkbox to check if it's selected
            $(".platform").each(function() {
                if ($(this).is(":checked")) {
                    platforms.push($(this).val());
                }
            });

            // Check if at least one platform is selected
            if (platforms.length === 0) {
                alert("Please select at least one platform.");
                return; // Stop further execution if no platform is selected
            }

            // Create the postData object with dynamic values
            var postData = {
                post: postText,
                platforms: platforms,
            };

            const API_KEY = "B9F3BQ9-7GZM27P-N4MJ635-HH5T32Y";

            $.ajax({
                url: "https://app.ayrshare.com/api/post",
                type: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${API_KEY}`
                },
                data: JSON.stringify(postData),
                success: function(response) {
                    // Clear post text and unselect all platform switches
                    $("#postTextarea").val(""); // Clear post text area

                    // Unselect all platform switches (checkboxes)
                    $(".platform").prop("checked", false);
                    $("#responseDiv").show();
                    displayResponseData(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle error here
                }
            });


        }

        // Execute the function when the button is clicked using jQuery
        $(document).ready(function() {
            $("#getDataButton").click(function() {
                getPostData();
            });
        });

        function displayResponseData(response) {
            // Clear previous response data
            $("#responseContainer").empty();


            // Create HTML elements to display response data
            var responseHtml = '<h4>Posted on Platforms:</h4>';
            responseHtml += '<ul>';

            response.postIds.forEach(function(post) {
                responseHtml += '<li>';
                responseHtml += '<strong>Platform:</strong> ' + post.platform + '<br>';
                responseHtml += '<strong>Status:</strong> ' + post.status + '<br>';
                responseHtml += '<strong>Post URL:</strong> <a href="' + post.postUrl + '" target="_blank">' + post
                    .postUrl + '</a>';
                responseHtml += '</li>';
            });

            responseHtml += '</ul>';

            // Append response HTML to the container
            $("#responseContainer").html(responseHtml);
        }
    </script>


    <!--end::Row-->
</x-default-layout>
