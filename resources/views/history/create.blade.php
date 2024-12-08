<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                </svg>
            </span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="container mx-auto max-w-4xl py-8 px-4">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Yangi tarixiy hujjat Qo'shish</h1>
            <p class="text-gray-600">Yangi tarixiy hujjat qo'shing va izohlarni oling</p>
        </div>

        <form action="{{ route('history.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Yangi tarixiy hujjat
                    Sarlavhasi</label>
                <input type="text" name="title" id="title"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Tarixiy hujjatni qisqa sarlavhasi..." required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Tavsifi</label>
                <textarea name="description" id="description" rows="5"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Tarixiy hujjatni batafsil yozing..." required></textarea>
            </div>

            <div class="flex justify-end h-8">
                <select name="tags[]" id="tag"
                    class="rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700 w-full py-2 px-4 bg-white hover:bg-gray-50"
                    multiple>
                    <option selected disabled value="">Tarixiy hujjat qaysi bo'limiga tegishli</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <label for="file-upload"
                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 transition">
                    <input id="file-upload" type="file" accept=".pdf, .doc, .docx" class="hidden" name="file">
                    <div class=" flex flex-col items-center justify-center text-gray-600">
                        <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 16l4 4m0 0l4-4m-4 4V4m13 4h-3m3 0a1 1 0 00-1-1h-5a1 1 0 00-1 1v11a1 1 0 001 1h5a1 1 0 001-1V9m-3 3h3" />
                        </svg>
                        <p class="mt-2 text-sm ">Tarixiy hujjat to'liq <span
                                class="text-blue-500 font-semibold">PDF</span>
                            yoki <span class="text-blue-500 font-semibold">Word</span><br> file yuklash uchun bosing</p>
                    </div>
                </label>
                <button type="submit"
                    class="font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-1"
                    style="background-color: #4f46e5; color: white;">
                    Hujjatni yuborish
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById("file-upload").addEventListener("change", function() {
            const fileName = this.files[0]?.name || "No file chosen";
            const labelText = document.querySelector("label .text-sm");
            labelText.innerHTML = `Siz tanlagan file: <span class="text-blue-500 font-semibold">${fileName}</span>`;
        });
    </script>
</x-app-layout>
