<!DOCTYPE html>
<html>
<head>
    <title>ALl Cateogries</title>
</head>
<body>

   <ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        <ul>
        @foreach ($category->childrenCategories as $childCategory)
            @include('child_category', ['child_category' => $childCategory])
        @endforeach
        </ul>
    @endforeach
</ul>



</body>
</html>