<div>
    <label class="block text-sm font-medium text-slate-700">
        {{ $label }}
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        class="w-full mt-1 bg-transparent placeholder:text-slate-400 text-sm border rounded-md px-3 py-2 transition duration-300 ease focus:outline-none shadow-sm focus:shadow
        {{ $errors->has($name)
            ? 'border-red-500 text-red-600 focus:border-red-500'
            : 'border-slate-200 text-slate-700 hover:border-blue-300 focus:border-blue-500' }}"
    >

    @error($name)
    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
    @enderror
</div>
