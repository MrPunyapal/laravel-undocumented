# `withAggregate()`

**Description:** Adds a subselect to the query that fetches a single column from a related model without eager loading the full relationship. The value is accessible as a dynamically named attribute (`{relation}_{column}`) on the result.

This is the underlying method that powers `withCount()`, `withSum()`, `withMax()`, `withMin()`, `withAvg()`, and `withExists()`.

## Signature

```php
withAggregate(mixed $relations, string $column, string $function = null): static
```

## Usage

```php
use App\Models\Post;

$posts = Post::query()
    // You maybe already know:
    ->withCount('comments')     // adds comments_count
    ->withSum('comments', 'votes') // adds comments_sum_votes

    // You might not know this — fetch a single relationship column
    // without loading the full model or running extra queries.
    // Works great for one-to-one / belongsTo relationships.
    ->withAggregate('user', 'name')  // adds user_name

    ->get();

echo $posts->first()->user_name; // "John Doe"
```

## How it works

`withAggregate()` adds a correlated subquery to the main SQL query. For example, `withAggregate('user', 'name')` produces something like:

```sql
SELECT
    posts.*,
    (
        SELECT users.name
        FROM users
        WHERE users.id = posts.user_id
        LIMIT 1
    ) AS user_name
FROM posts
```

## Notes

- The generated attribute name follows the pattern `{snake_case_relation}_{column}`.
- For aggregate functions pass the `$function` argument (e.g. `'SUM'`, `'MAX'`). When `null`, it selects the raw column value.
- All the familiar helper methods (`withCount`, `withSum`, `withMax`, `withMin`, `withAvg`, `withExists`) delegate to this single method internally.

## Source

`Illuminate\Database\Eloquent\Concerns\QueriesRelationships::withAggregate()`

---

[← Back to README](../../README.md)
