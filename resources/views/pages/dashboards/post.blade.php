<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">

        </div>

        <!--end::Col-->
    </div>
    <!--end::Row-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const API_KEY = "B9F3BQ9-7GZM27P-N4MJ635-HH5T32Y";

        // Data to send in the POST request
        const postData = {
            post: "Today is a great day!", // required
            platforms: ["telegram"], // required
            mediaUrls: ["https://img.ayrshare.com/012/gb.jpg"] // optional
        };

        // Make the AJAX POST request using jQuery
        $.ajax({
            url: "https://app.ayrshare.com/api/post",
            type: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${API_KEY}`
            },
            data: JSON.stringify(postData),
            success: function(json) {
                console.log(json);
                // Handle success response here
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error here
            }
        });
    </script>


    <!--end::Row-->
</x-default-layout>
