<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Livewire\Livewire;
use App\Livewire\Admin\Product\ProductIndexComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexComponentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        // Создаем админа
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);
        
        // Создаем категории
        $this->category = Category::factory()->create(['name' => 'Test Category']);
        
        // Создаем продукты
        Product::factory(5)->create([
            'category_id' => $this->category->id
        ]);
    }

    public function test_component_can_render()
    {
        Livewire::test(ProductIndexComponent::class)
            ->assertStatus(200);
    }

    public function test_component_displays_products()
    {
        // Создаем продукт с уникальным именем специально для теста
        $uniqueProduct = Product::factory()->create([
            'name' => 'UniqueTestProduct',
            'category_id' => $this->category->id
        ]);
        
        // Проверяем, что компонент содержит имя созданного продукта
        Livewire::test(ProductIndexComponent::class)
            ->assertSeeHtml('UniqueTestProduct');
            
        // Удаляем тестовый продукт после теста
        $uniqueProduct->delete();
    }

    public function test_search_functionality()
    {
        $searchProduct = Product::factory()->create([
            'name' => 'Unique Product Name',
            'category_id' => $this->category->id
        ]);
        
        Livewire::test(ProductIndexComponent::class)
            ->set('search', 'Unique Product')
            ->assertSee('Unique Product Name')
            ->assertDontSee(Product::where('name', '!=', 'Unique Product Name')->first()->name);
    }

    public function test_category_filter()
    {
        $newCategory = Category::factory()->create(['name' => 'New Category']);
        $newProduct = Product::factory()->create([
            'name' => 'New Category Product',
            'category_id' => $newCategory->id
        ]);
        
        Livewire::test(ProductIndexComponent::class)
            ->set('selectedCat', $newCategory->id)
            ->assertSee('New Category Product')
            ->assertDontSee(Product::where('category_id', '!=', $newCategory->id)->first()->name);
    }

    public function test_sort_functionality()
    {
        Livewire::test(ProductIndexComponent::class)
            ->call('sortType', 'name')
            ->assertSet('sortBy', 'name')
            ->assertSet('sortDirection', 'asc');
    }

    public function test_delete_product()
    {
        $product = Product::first();
        
        Livewire::test(ProductIndexComponent::class)
            ->call('deleteId', $product->id)
            ->assertSet('delId', $product->id)
            ->call('destroy')
            ->assertRedirect(route('admin.product.index'));
            
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}





