<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Crud</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
    @layer utilities {
      .container{
        @apply px-10 mx-auto;
      }
      .borderline{
        border: 1px solid black;
      }
    }
  </style>
</head>
<body>
    <div class="container">
        <div class="flex justify-between">
        <h2 class="text-red-500 text-xl">This is text</h2>
        <a href="/create" class="bg-green-600 text-white rounded py-2 px-4"><b>Back to Home</b></a>
        </div>

        <div>
            @if(session('success'))
                <h2 class="text-green-600">{{session('success')}}</h2>
            @endif

                <form method="POST" action="{{route('store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col gap-5">

                        <label for="name">Enter Name</label>
                        <input type="text" name="name" class="borderline" value="{{old('name')}}">
                        @error('name')
                            <p class="text-red-600">Name is required</p>
                        @enderror

                        <label for="Description">Enter Description</label>
                        <input type="text" name="Description" class="borderline" value="{{old('Description')}}">
                        @error('Description')
                            <p class="text-red-600">Description is required</p>
                        @enderror

                        <input type="file" name="image">
                        @error('image')
                            <p class="text-red-600">Image format didn't match</p>
                        @enderror

                        <div>
                            <input type="submit" class="bg-green-500 py-2 px-4 rounded inline-block">
                        </div>
                    </div>
                </form>

    </div>


    <div class="">
    <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Post Name</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allPosts as $post)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $post->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->Description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <img src="{{ asset('UploadedImage/' . $post->image) }}" alt="Post Image" class="h-10 w-10 rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <a href="{{route('update',$post->id)}}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



               
    </div>


    </div>

    

</body>
</html>