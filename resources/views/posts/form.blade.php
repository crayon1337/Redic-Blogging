<div class="row">
    <div class="col-6">
        <label>Title </label>
        <input type="text" class="form-control" name="title" value="{{ old('title') ?? $post->title }}">
    </div>
    <div class="col-6">
        <label>Category</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ?? 'selected' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-2">
        <label>Thumbnail (External URL)</label>
        <input type="text" class="form-control" name="imgUrl" value="{{ old('imgUrl') ?? $post->imgUrl }}">
    </div>
    <div class="col mt-2">
        <label>Body</label>
        <textarea class="form-control" id="idTextFieldBody" name="body">{!! old('body') ?? $post->body !!}</textarea>
    </div>
</div>
<input type="submit" value="Submit" class="btn btn-success btn-bg mt-2">