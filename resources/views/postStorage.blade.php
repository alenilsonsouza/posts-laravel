<x-layout title={{$title}}>
    <div class="container">
        <div class="post-area">
            <div class="button-area">
                <a href="javascript:history.back();">Voltar</a>
            </div>
            @if ($page == 'addPost')
                <h1>Adicionar Post</h1>
            @else
                <h1>Editar Post {{ $post->title }}</h1>
            @endif

            @if($flash)
                <div class="warning">
                    {{$flash}}
                </div>
            @endif

            <form action="{{ $actionForm }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($post)
                    <img src="{{ $post->cover }}" alt="" width="150">
                    <input type="hidden" name="id" value="{{ $post->id }}">
                @endif
                <div class="input">
                    <label for="cover">Escolha a capa</label>
                    <input type="file" name="cover" id="cover" {{ $page == 'addPost' ? 'required' : '' }}>
                </div>
                <div class="input">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" required placeholder="Adicione o título"
                        value="{{ $post ? $post->title : '' }}">
                </div>
                <div class="input">
                    <label for="text">Texto</label>
                    <textarea name="text" id="text" required placeholder="Adicione o texto">{{ $post ? $post->text : '' }}</textarea>
                </div>

                <div class="input button-area">
                    <button type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
