
<style>
    .hidden {
        display: none;
    }
    .error-text {
        padding: 6px;
        background-color: red;
        border-radius: 10px;
        width: 25%;
    }

    .hide {
        display: none;
    }
</style>

<body>
    <form id="formData">
         @csrf

        <div>
            <label for="firstname">FirstName</label>
            <input type="text" name="FirstName" id="firstname" class="form-control" placeholder="Your firstname">
            <p class="text-danger error-text FirstName_error hide" style="font-size: 13px"></p>
        </div>

        <div>
            <label for="lastname">LastName</label>
            <input type="text" name="LastName" id="lastname" class="form-control" placeholder="Your Lastname">
            <p class="text-danger error-text LastName_error hide" style="font-size: 13px"></p>
        </div>

        <div class="hidden">
            <input type="student" name="student_id" id="student_id">
        </div>
        <div>
            <label for="course">Course</label>
            <select name="course">
                <option>Select a Course</option>
                <option>Marine science</option>
                <option>Computer science</option>
                <option>Agricultural science</option>
            </select>
            <p class="text-danger error-text course_error hide" style="font-size: 13px"></p>
        </div>

        <div>
            <label for="phonenumber">Phone number</label>
            <input type="number" name="phonenumber" id="phonenumber" class="form-control" placeholder="Your Phonenumber">
            <p class="text-danger error-text phonenumber_error hide" style="font-size: 13px"></p>
        </div>

        <div>
            <button type="button" id="save_student">Save</button>
            <button type="button" onclick="resetStudent()">Reset</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('sb-admin/js/create.js') }}" type="text/javascript"></script>

    <script>
            $(document).ready(function() {
                $('#save_student').click(function(event) {
                    event.preventDefault();

                    //let form = $("#formData")[0];
                    //let data = new FormData(form);

                    console.log('===you have been clicked=====');

                    $.ajax({
                        url: "{{ route('students.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: $('#formData').serialize(),
                        beforeSend: function() {
                            $(document).find('p.error-text').text('');
                        },
                        success: function(data) {
                            console.log(data);
                            console.log(data.student);

                            if(data.status == 422) {
                                $("p").removeClass("hide");

                                $.each(data.errors, function(prefix, val) {
                                    $("p." + prefix + "_error").text(val[0]);
                                });

                            } else {
                                $('#formData')[0].reset();
                                window.location.href = "{{ route('students.index') }}";
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Request Error:", error);
                            console.error(xhr.responseText);
                            alert('An error occurred while processing your request.');
                        }
                    });
                });
            });
    </script>

