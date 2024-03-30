<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Check if user is logged in -->
    @auth

        <!-- In case it is -->
        <p>Congrats, you are logged in!</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>

        <!-- Form for creating new post -->
        <div style="border: 3px solid black;">
            <h2>Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content..."></textarea>
                <button>Save post</button>
            </form>
        </div>

        <!-- Display posts -->
        <div style="border: 3px solid black;">
            <h2>All Posts</h2>
            <!-- Iterade over posts array -->
            @foreach($posts as $post)
            <div style="background-color: gray; padding: 10px; margin: 10px;">
                <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                {{$post['body']}}
                <!-- Link to edit post -->
                <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                <!-- Button to delete post -->
                <form action="/delete-post/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>

            </div>
            @endforeach
        </div>

    <!-- In case it's not -->
    @else

        <!--- Register form -->
        <div style="border: 3px solid black;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
            </form>
        </div>

        <!--- Login form -->
        <div style="border: 3px solid black;">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="name">
                <input name="loginpassword" type="password" placeholder="password">
                <button>Login</button>
            </form>
        </div>

    @endauth

    
</body>
</html>