@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
        @csrf 
        @method('PATCH')
        @include('posts.form')
    </form>
@endsection

@section('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init( {
        selector:      "textarea#idTextFieldBody",
        theme:         "modern",
        width:         "100%",
        height:        200,
        plugins:       [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar:       "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons fontsizeselect",
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]

    } );
</script>
@endsection