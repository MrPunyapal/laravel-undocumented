# `setRelation()`

**Description:** Manually sets a loaded relationship value on an Eloquent model instance without running an additional query.

This is useful when you already have the related model in memory and want to avoid repeated relation hydration work.

## Signature

```php
setRelation(string $relation, mixed $value): $this
```

## Usage

```php
use App\Models\Team;

$team = Team::current();

$sites = $team->sites()->get()
    ->map(function ($site) use ($team) {
        // Reuse the already-loaded parent object.
        return $site->setRelation('team', $team);
    });

// Accessing $site->team will not trigger another query.
```

## Why it matters

In multi-tenant or parent-child loops, this can prevent hidden N+1 behavior caused by repeatedly resolving the same parent relation.

## Sources

- API docs (Laravel 13): https://api.laravel.com/docs/13.x/Illuminate/Database/Eloquent/Concerns/HasRelationships.html#method_setRelation
- Community example: https://freek.dev/2311-increase-performance-by-using-eloquents-setrelation-method

---

[← Back to README](../../README.md)
