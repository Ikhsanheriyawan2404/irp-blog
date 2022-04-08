<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name')
        is-invalid
    @enderror" name="name" value="{{ $product->name ?? old('name') }}">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control @error('price')
        is-invalid
    @enderror" name="price" value="{{ $product->price ?? old('price') }}">
    @error('price')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" class="form-control @error('discount')
        is-invalid
    @enderror" name="discount" value="{{ $product->discount ?? old('discount') }}" min="0" max="100">
    @error('discount')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="shop_id">Shop</label>
    <select type="number" class="form-control @error('shop_id')
        is-invalid
    @enderror" name="shop_id">
        <option selected disabled>Choose Shop</option>
        @foreach ($shops as $shop)
            <option value="{{ $shop->id }}" {{ $shop->id == $product->shop_id ? 'selected' : '' }}>{{ $shop->name }}</option>
        @endforeach
    </select>
    @error('shop_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control @error('image')
        is-invalid
    @enderror" name="image">
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" class="form-control @error('description')
        is-invalid
    @enderror" name="description">{{ $product->description ?? old('description') }}</textarea>
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<button type="submit" class="btn btn-primary float-right">Save</button>
