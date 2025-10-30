<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->integer('sType')->default(0)->nullable();
            $table->string('sku')->nullable();
            $table->integer('image_type')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->string('slider')->nullable();
            $table->integer('category')->nullable();
            $table->integer('collection')->nullable();
            $table->integer('price')->nullable();
            $table->integer('special_price')->nullable();
            $table->integer('tag_price')->nullable();
            $table->integer('quantity_stock')->default(0)->nullable();
            $table->integer('quantity_memo')->default(0)->nullable();
            $table->integer('price_xml')->default(0)->nullable();
            $table->text('long_description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('sUrlkey')->nullable();
            $table->string('sCountryName')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('keyword')->nullable();
            $table->text('sRelatedProductid')->nullable();
            $table->string('nWeight')->nullable();
            $table->string('TaxClass')->nullable();
            $table->integer('Visibility')->default(0)->nullable();
            $table->timestamp('ProductfromDate')->nullable();
            $table->timestamp('ProducttoDate')->nullable();
            $table->integer('sStock')->default(0)->nullable();
            $table->text('sImagethumbnail')->nullable();
            $table->timestamp('dStartdate')->nullable();
            $table->timestamp('denddate')->nullable();
            $table->float('DiscountRate')->default('0')->nullable();
            $table->integer('nNoOfItemsOnMemo')->default(0)->nullable();
            $table->integer('nNoOfTotalItem')->default(0)->nullable();
            $table->text('sDescription2')->nullable();
            $table->integer('nInventoryOnHand')->nullable();
            $table->string('bShowonDibs')->nullable();
            $table->string('bShowonBluefly')->nullable();
            $table->string('bShowonEtsy')->nullable();
            $table->string('bDoNotList')->nullable();
            $table->string('beBay')->nullable();
            $table->string('bAmazon')->nullable();
            $table->string('bArtisan')->nullable();
            $table->string('bSocheec')->nullable();
            $table->string('bPriceupdationflag')->nullable();
            $table->string('sProductThumbnail')->nullable();
            $table->string('sProductBigImage')->nullable();
            $table->string('sMetalId')->nullable();
            $table->string('ItemCategoryCode')->nullable();
            $table->string('PrimaryCollection')->nullable();
            $table->string('StockType')->nullable();
            $table->integer('order_no')->default(0)->nullable();
            $table->integer('bDoNotShow')->default('0')->nullable();
            $table->integer('status')->default('0');
            $table->integer('active')->default('0');
            $table->text('Decription3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
