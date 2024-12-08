<x-app-layout>
    <div class="container mx-auto max-w-4xl py-8 px-6 contain-content">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif
        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
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
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif
        @role('admin')
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Tarixiy hujjatlar ro'yxati</h1>
                <a href="{{ route('history.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                    Tarixiy hujjatlar qo'shish
                </a>
            </div>
        @endrole
        <div class="mb-6">
            <form method="GET" action="{{ route('history.index') }}">
                <label for="tag" class="block text-sm font-medium text-gray-700">Teg bo'yicha filtr</label>
                <select name="tag_id" id="tag" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Barcha teglar</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Filtrlash
                </button>
            </form>
        </div>

        @forelse ($histories as $history)
            <a href="{{ route('history.show', $history->id) }}" class="hover:text-blue-600 transition">
                <div class="bg-white shadow-md rounded-lg mb-6 p-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition">
                            <span>Sarlavhasi: </span> {{ $history->title }}
                        </h2>

                        <p class="text-sm text-gray-600 mb-4">
                            <span class="font-medium text-gray-800">Qachon qo'shilgan:</span>
                            <span> - {{ $history->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="text-gray-700 mb-4">
                            <span>Qisqacha malumot: </span> {{ $history->description }}
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                <span class="block sm:inline">Ma'lumot topilmadi.</span>
            </div>
        @endforelse
    </div>
</x-app-layout>
