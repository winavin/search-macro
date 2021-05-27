# search-macro
Useful for Searching in Models

## Installation

in your `App\Providers\AppServiceProvider.php` add below code in `boot` method

```
Builder::macro('search', function ($attributes, string $searchTerm)
{
    $searchTerm = str_replace(' ', '%', $searchTerm);
    if (is_array($attributes))
    {
        $this->where(function (Builder $query) use ($attributes, $searchTerm)
        {
            foreach ($attributes as $attribute)
            {
                $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
        });
    } else
    {
        $this->where(function (Builder $query) use ($attributes, $searchTerm)
        {
            $query->orWhere($attributes, 'LIKE', "%{$searchTerm}%");
        });
    }
    return $this;
});
```

## Uses

# Search One Coloum

You can search in one coloum
```
YourModel::search('coloum_name_where_you_want_to_search', 'string_to_search')->get();
```

# Search Multiple Coloums
You can provide array to search in multiple coloums
```
YourModel::search(['coloum_one', 'coloum_two', 'coloum_three'], 'string_to_search')->get();
```


## Credits

This is just updated version of code given below

https://sergio.bruder.com.br/2018/10/search-eloquent-macro/
