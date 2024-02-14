@props(['disabled' => false, 'pickerId'])



<input {{ $disabled ? 'disabled' : '' }} id="{{$pickerId}}" {!! $attributes->merge(['class' => 'block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>


<script>

    const fp =flatpickr('#{{$pickerId}}', {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
