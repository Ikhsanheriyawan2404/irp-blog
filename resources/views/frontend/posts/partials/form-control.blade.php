<div class="form-group">
    <label for="title">Judul <small class="text-danger">*</small></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') ?? $post->title }}" autofocus>
    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="meta_description">Deskripsi <small class="text-secondary">tidak wajib diisi</small></label>
    <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" value="{{ old('meta_description') ?? $post->meta_description }}" placeholder="Deskripsi singkat artikel anda...">
    @error('meta_description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="meta_keyword">Kata Kunci <small class="text-secondary">boleh kosong</small></label>
    <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') ?? $post->meta_keyword }}" placeholder="contoh: Keyword1, Keyword2, Keyword3">
    @error('meta_keyword')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="thumbnail">Thumbnail <small class="text-secondary">boleh kosong</small></label>
    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail') ?? $post->thumbnail }}">
    @error('thumbnail')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category <small class="text-danger">*</small></label>
    <select type="text" class="form-control category @error('category') is-invalid @enderror" name="category[]" id="category" multiple>
        @foreach ($categories as $category)
            <option {{ $post->categories()->find($category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body <small class="text-danger">*</small></label>
    <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
