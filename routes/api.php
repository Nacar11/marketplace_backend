<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\VariationOptionController;
use App\Http\Controllers\ProductConfigurationController;
use App\Http\Controllers\ShoppingCartItemController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\UserPaymentMethodController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CityController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('getUserData', [UserController::class, 'getUserData']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('productItem/{product}', [ProductItemController::class, 'show']);
    Route::post('productItem', [ProductItemController::class, 'store']);
    Route::get('getFavoritesByUser', [FavoriteController::class, 'getFavoritesByUser']);
    Route::post('addToFavorites', [FavoriteController::class, 'addToFavorites']);
    Route::delete('removeFromFavorites', [FavoriteController::class, 'removeFromFavorites']);

    Route::get('getRegionsByCountryId/{id}', [RegionController::class, 'getRegionsByCountryId']);
    Route::get('getCitiesByRegionId/{id}', [CityController::class, 'getCitiesByRegionId']);
    Route::get('productItemsbyCategory/{id}', [ProductItemController::class, 'getProductItemsByCategory']);
    Route::get('product', ProductController::class);
    Route::get('getProductTypesByCategory/{id}', [ProductCategoryController::class, 'getProductTypesByCategory']);
    Route::get('getProductItemsByProductType/{id}', [ProductItemController::class, 'getProductItemsByProductType']);
    Route::get('getProductItemsByUser', [ProductItemController::class, 'getProductItemsByUser']);

    Route::get('getVariantsByProductTypes/{id}', [ProductController::class, 'getVariantsByProductTypes']);
 
    Route::get('variationOptions/{id}', [VariationController::class, 'getVariationOptions']);
    Route::get('variation', VariationController::class);
    Route::get('variation/{variation}', [VariationController::class, 'show']);


    Route::get('product-configuration', [ProductConfigurationController::class, 'getAll']);
    

    Route::get('variation-option', VariationOptionController::class);
    Route::get('variation-option/{id}', [VariationOptionController::class, 'show']);
 
    Route::put('variation-option/{id}', [VariationOptionController::class, 'update']);
    Route::delete('variation-option/{id}', [VariationOptionController::class, 'destroy']);

    Route::get('getShoppingCartItemsByUser', ShoppingCartItemController::class);
    Route::get('getCartItemByID/{id}', [ShoppingCartItemController::class, 'getCartItemByID']);
    Route::post('addToCart', [ShoppingCartItemController::class, 'addToCart']);
    Route::delete('deleteCartItem/{cartItemId}', [ShoppingCartItemController::class, 'deleteCartItem']);
Route::put('selectForCheckout/{id}/',  [ShoppingCartItemController::class, 'selectCartItemForCheckout']);
Route::put('unSelectForCheckout/{id}',  [ShoppingCartItemController::class, 'unselectCartItemForCheckout']);
    Route::get('/countries', CountryController::class);
    Route::post('/addAddress', [AddressController::class, 'store']);
    Route::get('/getAddresses', [AddressController::class, 'getAddresses']);
    Route::get('/userHasAddress', [AddressController::class, 'userHasAddress']);
    Route::delete('/deleteAddress/{id}', [AddressController::class, 'deleteAddress']);
    Route::post('/setDefaultAddress/{id}', [AddressController::class, 'setDefaultAddress']);

    Route::get('/paymentTypes', PaymentTypeController::class);
    Route::get('/userPaymentMethods', UserPaymentMethodController::class);
    Route::put('/updateUPM', [UserPaymentMethodController::class, 'update']);
    Route::get('/getUPMbyID', [UserPaymentMethodController::class, 'getUPMbyID']);

 
    Route::get('getOrderLinesByID', [OrderLineController::class,'getOrderLinesByUser']);
    Route::get('/getAllOrderLines', [OrderLineController::class, 'getAllOrderLines']);
    Route::get('/getSingleOrderLine/{id}', [OrderLineController::class, 'getSingleOrderLine']);
    Route::post('/addOrderLine', [OrderLineController::class, 'store']);
    Route::get('/getOrderlinesFromProductListings', [OrderLineController::class, 'getOrderLinesFromProductListings']);
    Route::delete('deleteOrderLinesByID/{ID}', [OrderLineController::class, 'deleteOrderLine']);


    Route::get('/getFirstShipping', [ShippingMethodController::class, 'getFirst']);
    Route::get('/getShippingMethods', ShippingMethodController::class);
    Route::post('/addListing', [ProductItemController::class, 'addListing']);
    Route::delete('deleteListingByID/{itemID}', [ProductItemController::class, 'deleteListing']);


    Route::get('getCartItemsForUser', [ShoppingCartItemController::class, 'getCartItemsForUser']);


});

Route::post('changePass', [AuthController::class, 'changePassword']);
Route::get('/users', AuthController::class);
Route::post('/getEmailVerificationCode', [AuthController::class, 'getEmailVerificationCode']);
Route::post('/SMSVerificationCode', [AuthController::class, 'SMSVerificationCode']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('test',function(){
    return 'success';
});
Route::get('product-category', ProductCategoryController::class);
Route::get('product-category/{id}', [ProductCategoryController::class, 'show']);

// Route::get('getProductItemByCategory/{id}', [ProductCategoryController::class, 'getProductItemsByCategory']);

Route::get('productItems', ProductItemController::class);
Route::get('/getProductItem/{id}', [ProductItemController::class, 'getProductItem']);

Route::get('auth/facebook', [AuthController::class, 'facebookpage']);
Route::post('google/callback', [AuthController::class, 'googleRedirect']);
Route::post('facebook/callback', [AuthController::class, 'facebookRedirect']);

Route::post('/checkEmail', [AuthController::class, 'checkEmail']);
Route::post('/getUserByEmail', [AuthController::class, 'getUserByEmail']);
Route::post('/checkUsername', [AuthController::class, 'checkUsername']);


Route::post('variation/', [VariationController::class, 'store']);
Route::post('product-configuration', [ProductConfigurationController::class, 'add']);
Route::post('variation-option/', [VariationOptionController::class, 'store']);