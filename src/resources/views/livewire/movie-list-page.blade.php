<div class="min-h-screen bg-slate-950 text-white">

```
<livewire:hero-section />

<div
    id="movies"
    class="max-w-7xl mx-auto px-6 py-16"
>

    <div class="flex justify-between items-center mb-8">

        <h2 class="text-3xl font-bold">
            Now Showing
        </h2>

    </div>

    <input
        type="text"
        wire:model.live="search"
        placeholder="Cari film..."
        class="
            w-full
            mb-10
            px-5
            py-4
            rounded-xl
            bg-slate-900
            border
            border-slate-800
            text-white
            focus:outline-none
            focus:ring-2
            focus:ring-amber-500
        "
    >

    <div class="grid md:grid-cols-4 gap-6">

        @forelse($movies as $movie)

            <a
                href="{{ route('movies.show', $movie) }}"
                class="
                    bg-slate-900
                    border
                    border-slate-800
                    rounded-2xl
                    overflow-hidden
                    hover:scale-105
                    transition
                    duration-300
                "
            >

                <img
                    src="{{ Storage::url($movie->poster) }}"
                    alt="{{ $movie->title }}"
                    class="
                        w-full
                        h-80
                        object-cover
                    "
                >

                <div class="p-4">

                    <h3
                        class="
                            text-lg
                            font-bold
                            mb-2
                        "
                    >
                        {{ $movie->title }}
                    </h3>

                    <p class="text-slate-400 mb-4">
                        {{ $movie->duration }} Menit
                    </p>

                    <div
                        class="
                            inline-block
                            px-4
                            py-2
                            rounded-lg
                            bg-amber-500
                            text-black
                            font-semibold
                        "
                    >
                        Detail Film
                    </div>

                </div>

            </a>

        @empty

            <div class="col-span-4 text-center text-slate-400">

                Film tidak ditemukan.

            </div>

        @endforelse

    </div>

</div>

<livewire:feature-section />

<livewire:footer-section />
```

</div>
