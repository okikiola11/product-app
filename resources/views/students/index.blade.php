@extends('layouts.app')

@section('content')

    <h1>Student Records</h1>
    <div>
        Display all students records
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <button type="button" id="createPostButton" class="btn btn-success mb-3">+ Create Post</button>

    <div id="students-list">
        @foreach ($students as $student)
            <h3>{{ $student->FirstName }} {{ $student->LastName }}</h3>

            @foreach ($student->courses as $course)
                <p>Offers {{ $course->title }}
                    <button>{{ $student->courses->count() }} courses</button>
                </p>
            @endforeach

            <ul>
                @if($student->comments_count)

                    @foreach ($student->comments as $comment)
                        <li> {{ $comment->content }} </li>
                    @endforeach
                    <p>{{ $student->comments_count }} comments</p>

                @else
                    <div>There are no comments yet!</div>
                @endif


                <p>
                    <button onClick="showStudent()">Show</button>

                    <button onClick="editStudent()">Edit</button>

                    <button onClick="deleteStudent()">Delete</button>
                </p>
            </ul>
        @endforeach

    </div>
@endsection

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){

            document.getElementById("createPostButton").addEventListener("click", function() {
                window.location.href = "{{ route('students.create') }}";
            });
        });
    </script>
</body>
</html>
