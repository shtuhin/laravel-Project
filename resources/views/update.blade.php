<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD - Update</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
    @layer utilities {
        .container {
            @apply px-10 mx-auto;
        }
        .borderline {
            border: 1px solid black;
        }
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="flex justify-between">
            <h2 class="text-red-500 text-xl">Update Post</h2>
            <a href="{{ route('create') }}" class="bg-green-600 text-white rounded py-2 px-4"><b>Back to Home</b></a>
        </div>

        <div>
            @if(session('success'))
                <h2 class="text-green-600">{{ session('success') }}</h2>
            @endif

            <form method="POST" action="{{ route('update.post', $sendedPost->id) }}" enctype="multipart/form-data" class="mb-6">
                @csrf
                @method('PUT') <!-- Required for update -->

                <div class="flex flex-col gap-5">
                    <label for="name">Enter Name</label>
                    <input type="text" name="name" class="borderline" value="{{ $sendedPost->name }}">
                    @error('name')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="Description">Enter Description</label>
                    <input type="text" name="Description" class="borderline" value="{{ $sendedPost->Description }}">
                    @error('Description')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="image">Upload Image</label>
                    <input type="file" name="image">
                    <p class="text-gray-600">Current Image:
                        <img src="{{ asset('UploadedImage/' . $sendedPost->image) }}" alt="Post Image" class="w-16 h-16">
                    </p>
                    @error('image')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror

                    <div>
                        <input type="submit" value="Update Post" class="bg-green-500 py-2 px-4 rounded inline-block">
                    </div>
                </div>
            </form>

            
            <form method="POST" action="{{ route('delete.post', $sendedPost->id) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE') 
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Delete Post</button>
            </form>
        </div>
    </div>
</body>
</html>
