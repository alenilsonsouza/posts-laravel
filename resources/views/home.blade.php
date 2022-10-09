<x-layout title="{{ $title }}">
    <div class="container">
        <div class="button-area">
            <a href="{{ env('APP_URL') }}/postadd">Adicionar Post</a>
        </div>
        <div class="post-area">
            @if (count($posts) > 0)
                @foreach ($posts as $item)
                    <div class="post-item">
                        <div class="cover">
                            <img src="{{ $item->cover }}" alt="" width="200">
                        </div>
                        <div class="post-content">
                            <h2>{{ $item->title }}</h2>

                            <div class="text">
                                {{ $item->text }}
                            </div>
                            <div class="button-area">
                                <a href="{{ env('APP_URL') }}/postedit/{{ $item->id }}">Editar</a>
                                <a href="{{ env('APP_URL') }}/postdelete/{{ $item->id }}">Excluir</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                Nenhum post para mostrar.
            @endif
        </div>
        <div class="paginate">
            {{ $posts->links() }}
        </div>

    </div>
</x-layout>
