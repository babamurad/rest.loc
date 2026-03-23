<ul class="ml-4 list-disc">
    @foreach ($categories as $category)
        <li>
            {{ $category->name }}

            @if ($category->children->isNotEmpty())
                @include('livewire.partials.category-tree', ['categories' => $category->children])
            @endif
        </li>
    @endforeach
</ul>
