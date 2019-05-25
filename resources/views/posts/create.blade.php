@extends('layouts.app')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <label>Title </label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="col-6">
                <label>Category</label>
                <select name="categoryId" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 mt-2">
                <label>Thumbnail (External URL)</label>
                <input type="text" class="form-control" name="imgUrl">
            </div>
            <div class="col mt-2">
                <label>Body</label>
                <textarea class="form-control" id="idTextFieldBody" name="body"></textarea>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-success btn-bg mt-2">
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