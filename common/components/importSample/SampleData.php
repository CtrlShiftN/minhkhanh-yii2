<?php

namespace common\components\importsample;

use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use common\components\SystemConstant;
//use common\models\Cart;
//use common\models\GeoLocation;
//use common\models\Order;
//use common\models\OrderTracking;
//use common\models\Post;
//use common\models\PostCategory;
//use common\models\PostTag;
//use common\models\Product;
//use common\models\ProductAssoc;
//use common\models\ProductCategory;
//use common\models\ProductType;
//use common\models\Social;
use common\models\Terms;
//use common\models\TrackingStatus;
//use common\models\Trademark;
use common\models\User;
use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;

class SampleData
{
    /**
     * user data
     * @var array[]
     */
    protected static $userInfoArr = [
        [
            'email' => 'admin.minhkhanh@gmail.com',
            'password_hash' => 'Iamadmin@1234',
            'name' => "Admin",
            'tel' => '0364752421',
            'username' => 'admin',
            'role' => User::ROLE_ADMIN,
        ],
        [
            'email' => 'editor.minhkhanh@gmail.com',
            'password_hash' => 'Iameditor@1234',
            'name' => "Writer God",
            'tel' => '0334517566',
            'username' => 'editor',
            'role' => User::ROLE_EDITOR,
        ],
        [
            'email' => 'sale.minhkhanh@gmail.com',
            'password_hash' => 'Iamsale@1234',
            'name' => "Sale",
            'tel' => '0345678910',
            'username' => 'sale',
            'role' => User::ROLE_SALE,
        ],
        [
            'email' => 'customer.minhkhanh@gmail.com',
            'password_hash' => 'Iamcustomer@1234',
            'name' => "Customer",
            'tel' => '0333333333',
            'username' => 'customer',
            'role' => User::ROLE_USER,
        ],
        [
            'email' => 'customer2.minhkhanh@gmail.com',
            'password_hash' => 'Iamcustomer@1234',
            'name' => "Customer2",
            'tel' => '0339583763',
            'username' => 'customer2',
            'role' => User::ROLE_USER,
        ]
    ];

    /**
     *
     * @throws Exception
     */
    public static function insertSampleUser()
    {
        $countUsers = 0;
        foreach (self::$userInfoArr as $values) {
            $user = new User();
            $user->email = $values['email'];
            $user->setPassword($values['password_hash']);
            $user->name = $values['name'];
            $user->tel = $values['tel'];
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            $user->username = $values['username'];
            $user->referral_code = strstr($values['email'], '@', true);
            $user->role = $values['role'];
            $user->created_at = date('Y-m-d H:m:s');
            $user->updated_at = date('Y-m-d H:m:s');
            if ($user->save()) {
                $countUsers++;
            }
        }
        echo "Inserted " . $countUsers . '/' . count(self::$userInfoArr) . ' users.' . PHP_EOL;
    }

    /**
     * product data
     * @var array[]
     */
    protected static $productInforArr = [
        [
            'name' => 'Áo thun UNISEX không cổ BOSS',
            'slug' => 'ao-thun-unisex-khong-co-boss',
            'short_description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>",
            'description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>
<li>T-Shirts</li>
<li>-Color：Black , White , Red, Blue, Yellow,Pink</li>
<li>-Sizes: XS  S M L XL  XXL  3XL </li>
<li>-If you like loose, please take a big size.</li>
<li>-Ships From:China</li>
<li>-Transportation time：It takes about 5-20 days, depending on the speed of logistics</li>
<li>-Product Description</li>
<li>-Brand New T-shirt </li>
<li>-Various tide brands</li>
<li>-We are committed to providing you with the best quality products at the best prices.</li>
",
            'cost_price' => 150000,
            'regular_price' => 299000,
            'discount' => null,
            'image' => 'product/clothes/top/shirt1.png',
            'images' => 'product/clothes/top/shirt1.png,product/clothes/top/shirt2.png,product/clothes/top/shirt3.png',
            'trademark_id' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo thun UNISEX không cổ HUGO-BOSS',
            'slug' => 'ao-thun-unisex-khong-co-hugo-boss',
            'short_description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>",
            'description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>
<li>T-Shirts</li>
<li>-Color：Black , White , Red, Blue, Yellow,Pink</li>
<li>-Sizes: XS  S M L XL  XXL  3XL </li>
<li>-If you like loose, please take a big size.</li>
<li>-Ships From:China</li>
<li>-Transportation time：It takes about 5-20 days, depending on the speed of logistics</li>
<li>-Product Description</li>
<li>-Brand New T-shirt </li>
<li>-Various tide brands</li>
<li>-We are committed to providing you with the best quality products at the best prices.</li>
",
            'cost_price' => 200000,
            'regular_price' => 400000,
            'discount' => null,
            'image' => 'product/clothes/top/shirt6.png',
            'images' => 'product/clothes/top/shirt1.png,product/clothes/top/shirt2.png,product/clothes/top/shirt3.png',
            'trademark_id' => 1,
            'quantity' => 182,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo thun UNISEX không cổ',
            'slug' => 'ao-thun-unisex-khong-co',
            'short_description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>",
            'description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>
<li>T-Shirts</li>
<li>-Color：Black , White , Red, Blue, Yellow,Pink</li>
<li>-Sizes: XS  S M L XL  XXL  3XL </li>
<li>-If you like loose, please take a big size.</li>
<li>-Ships From:China</li>
<li>-Transportation time：It takes about 5-20 days, depending on the speed of logistics</li>
<li>-Product Description</li>
<li>-Brand New T-shirt </li>
<li>-Various tide brands</li>
<li>-We are committed to providing you with the best quality products at the best prices.</li>
",
            'cost_price' => 200000,
            'regular_price' => 399000,
            'discount' => null,
            'image' => 'product/clothes/top/shirt3.png',
            'images' => 'product/clothes/top/shirt1.png,product/clothes/top/shirt2.png,product/clothes/top/shirt3.png',
            'trademark_id' => 1,
            'quantity' => 52,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo thun không cổ HUGO BOSS',
            'slug' => 'ao-thun-khong-co-hugo-boss',
            'short_description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>",
            'description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>
<li>T-Shirts</li>
<li>-Color：Black , White , Red, Blue, Yellow,Pink</li>
<li>-Sizes: XS  S M L XL  XXL  3XL </li>
<li>-If you like loose, please take a big size.</li>
<li>-Ships From:China</li>
<li>-Transportation time：It takes about 5-20 days, depending on the speed of logistics</li>
<li>-Product Description</li>
<li>-Brand New T-shirt </li>
<li>-Various tide brands</li>
<li>-We are committed to providing you with the best quality products at the best prices.</li>
",
            'cost_price' => 300000,
            'regular_price' => 599000,
            'discount' => null,
            'image' => 'product/clothes/top/shirt4.png',
            'images' => 'product/clothes/top/shirt1.png,product/clothes/top/shirt2.png,product/clothes/top/shirt3.png',
            'trademark_id' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo T-shirt HUGO BOSS',
            'slug' => 'ao-t-shirt-hugo-boss',
            'short_description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>",
            'description' => "<li>Category：Men's Wear   Clothing  Women’s Wear</li>
<li>T-Shirts</li>
<li>-Color：Black , White , Red, Blue, Yellow,Pink</li>
<li>-Sizes: XS  S M L XL  XXL  3XL </li>
<li>-If you like loose, please take a big size.</li>
<li>-Ships From:China</li>
<li>-Transportation time：It takes about 5-20 days, depending on the speed of logistics</li>
<li>-Product Description</li>
<li>-Brand New T-shirt </li>
<li>-Various tide brands</li>
<li>-We are committed to providing you with the best quality products at the best prices.</li>
",
            'cost_price' => 175000,
            'regular_price' => 349000,
            'discount' => null,
            'image' => 'product/clothes/top/shirt2.png',
            'images' => 'product/clothes/top/shirt1.png,product/clothes/top/shirt2.png,product/clothes/top/shirt3.png',
            'trademark_id' => 1,
            'quantity' => 97,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo sơ mi nam tay dài CÔNG SỞ LADOS',
            'slug' => 'ao-so-mi-nam-tay-dai-cong-so-lados',
            'short_description' => "<li>chất vải mát mịn chống nhăn</li>",
            'description' => "
<li> Chất liệu: vải kate lụa mịn mềm, thấm hút mồ hôi tốt.</li>
<li> Co giãn nhẹ, mặc cực thoải mái, ít nhăn</li>
<li> Chất vải đẹp, không xù lông, không phai màu</li>
<li> Đường may cực tỉ mỉ cực đẹp</li>
<li> Có thể mặc đi làm, đi chơi, dễ phối đồ, không kén người mặc</li>
<li> Kiểu dáng: Thiết kế theo form rộng vừa,đơn giản , dễ mặc ..Tôn lên được sự trẻ trung năng động cho các bạn nam, kèm vào đó là sự hoạt động thoải mái khi mặc sản phẩm.</li>
</li>Được sản xuất và bảo hành bởi Công ty TNHH MTV LADOS VIỆT NAM</li>
",
            'cost_price' => 800000,
            'regular_price' => 1600000,
            'discount' => 15,
            'image' => 'product/clothes/shirt/ao-so-mi-lados.jpg',
            'images' => '',
            'trademark_id' => 2,
            'is_feature' => 1,
            'quantity' => 31,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo Vest Nam Thời Trang The Shirts Studio Hàn Quốc',
            'slug' => 'ao-vest-nam-thoi-trang-the-shirt-studio-han-quoc',
            'short_description' => "",
            'description' => "
<li> Hàng nhập khẩu trực tiếp chính hãng từ Hàn Quốc.</li>
<li> Thiết kế đẹp mắt hợp thời trang, kiểu dáng trẻ trung. </li>
<li> Bộ Vest The Shirt Studio là dòng sản phẩm cao cấp,được thiết kế,may đo theo xu hướng hiện đại ,lịch lãm ,kiểu dáng body khoẻ khoắn.</li>
<li> <ul>Hướng dẫn bảo quản:<li> Giặt máy bằng nước lạnh</li><li> Không sử dụng chất tẩy mạnh.</li><li> Ủi nhẹ ở nhiệt độ tối đa 110°C.</li></ul></li>
</li> Thông tin thương hiệu The Shirt Studio là thương hiệu thời trang rất được giới trẻ ưa chuộng. Khác với những thương hiệu thời trang thông thường, The Shirt Studio không chú trọng vào những thiết kế mang tính thời thượng mà chỉ tập trung phát triển những mẫu trang phục cơ bản nhất, dễ phối đồ và luôn cần có trong tủ quần áo của các đấng mày râu. Thêm vào đó, sự khác biệt của The Shirt Studio còn thể hiện rõ nét thông qua chất liệu vải được tuyển chọn, xử lý kỹ lưỡng , thân thiện với môi trường, kết hợp cùng kiểu dáng không bao giờ lỗi mốt và những đường cắt may tinh xảo</li>
",
            'cost_price' => 600000,
            'regular_price' => 11999000,
            'discount' => 10,
            'image' => 'product/clothes/vest/vest-nam-han-quoc.jpg',
            'images' => '',
            'trademark_id' => 3,
            'quantity' => 152,
            'is_feature' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Quần tây nam co giãn nhẹ Lados',
            'slug' => 'quan-tay-nam-co-gian-nhe-lados',
            'short_description' => "",
            'description' => "<h3>Quần tây nam chất lượng LADOS - 327, chất vải dày dặn co giãn nhẹ, form slimfit </h3>
                <h4>⏩ Thông tin sản phẩm:</h4>
                👉 Chất liệu: Chất Vải dày, Không nhăn <br>
                👉 Co giãn nhẹ, đặc biệt không nhăn<br>
                👉 Chất vải đẹp, không xù lông, không phai màu<br>
                👉 Đường may cực tỉ mỉ cực đẹp<br>
                👉 Có thể mặc đi làm, đi chơi, dễ phối đồ, không kén người mặc<br>
                👉 Kiểu dáng: Thiết kế theo form Slimfit , dáng gọn, tôn dám trẻ trung- thông số phù hợp với người việt nam<br>
                ⏩Được sản xuất và bảo hành bởi Công ty TNHH MTV LADOS VIỆT NAM<br>
                <br><br>
                <h4>XEM CÁCH CHỌN SIZE TRÊN HÌNH ĐỂ ĐƯỢC CHÍNH XÁC NHẤT</h4>
                ⏩  Cách chọn size: Shop có bảng size mẫu. <br>
                Size 28 : 47kg-52kg<br>
                Size 29 : 50kg-57kg<br>
                Size 30 : 55kg-62kg<br>
                Size 31 : 60kg-67kg<br>
                Size 32 : 65kg-70kg<br>
                Size 34 : 67kg-72kg<br>
                Size 36 : 72kg-78kg",
            'cost_price' => 100000,
            'regular_price' => 299000,
            'discount' => 15,
            'image' => 'product/quan-tay-nam-co-gian-nhe-lados.jpg',
            'images' => '',
            'trademark_id' => 3,
            'quantity' => 527,
            'admin_id' => 1,
        ],
        [
            'name' => 'Quần tây kẻ kiểu dáng Hàn Quốc',
            'slug' => 'quan-tay-ke-kieu-dang-han-quoc',
            'short_description' => "",
            'description' => "<h3>Quần tây nam kẻ kiểu dáng Hàn Quốc </h3>
                <h4>⏩ Thông tin sản phẩm:</h4>
                👉 Chất liệu: Chất Vải dày, Không nhăn <br>
                👉 Co giãn nhẹ, đặc biệt không nhăn<br>
                👉 Chất vải đẹp, không xù lông, không phai màu<br>
                👉 Đường may cực tỉ mỉ cực đẹp<br>
                👉 Có thể mặc đi làm, đi chơi, dễ phối đồ, không kén người mặc<br>
                👉 Kiểu dáng: Thiết kế theo form Slimfit , dáng gọn, tôn dám trẻ trung- thông số phù hợp với người việt nam<br>
                <br><br>
                <h4>XEM CÁCH CHỌN SIZE TRÊN HÌNH ĐỂ ĐƯỢC CHÍNH XÁC NHẤT</h4>
                ⏩  Cách chọn size: Shop có bảng size mẫu. <br>
                Size 28 : 47kg-52kg<br>
                Size 29 : 50kg-57kg<br>
                Size 30 : 55kg-62kg<br>
                Size 31 : 60kg-67kg<br>
                Size 32 : 65kg-70kg<br>
                Size 34 : 67kg-72kg<br>
                Size 36 : 72kg-78kg",
            'cost_price' => 150000,
            'regular_price' => 350000,
            'discount' => 20,
            'image' => 'product/quan-tay-ke-kieu-dang-han-quoc.jpg',
            'images' => '',
            'trademark_id' => 3,
            'quantity' => 326,
            'hide' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo vest nam The Shirt Studio F4',
            'slug' => 'ao-vest-nam-the-shirt-studio-f4',
            'short_description' => "",
            'description' => "<h3>Áo vest nam The Shirt Studio F4 </h3>
                <h4>⏩ Thông tin sản phẩm:</h4>
                👉 Chất liệu: Chất Vải dày, Không nhăn <br>
                👉 Chất vải đẹp, không xù, không phai màu<br>
                👉 Đường may cực tỉ mỉ cực đẹp<br>
                👉 Có thể mặc đi làm, đi chơi, dễ phối đồ, không kén người mặc<br>
                👉 Kiểu dáng: Thiết kế dáng gọn, tôn dáng trẻ trung- thông số phù hợp với người Việt Nam<br>
                <br><br>
                <h4>XEM CÁCH CHỌN SIZE TRÊN HÌNH ĐỂ ĐƯỢC CHÍNH XÁC NHẤT</h4>
                ⏩  Cách chọn size: Shop có bảng size mẫu. <br>
                Size 28 : 47kg-52kg<br>
                Size 29 : 50kg-57kg<br>
                Size 30 : 55kg-62kg<br>
                Size 31 : 60kg-67kg<br>
                Size 32 : 65kg-70kg<br>
                Size 34 : 67kg-72kg<br>
                Size 36 : 72kg-78kg",
            'cost_price' => 140000,
            'regular_price' => 290000,
            'discount' => 10,
            'image' => 'product/ao-vest-nam-the-shirt-studio-f4.jpg',
            'images' => '',
            'trademark_id' => 3,
            'quantity' => 126,
            'hide' => 1,
            'admin_id' => 1,
        ],
    ];

    /**
     *
     */
    public static function insertSampleProduct()
    {
        $countProduct = 0;
        foreach (self::$productInforArr as $values) {
            $product = new Product();
            $product->name = $values['name'];
            $product->slug = $values['slug'];
            $product->short_description = $values['short_description'];
            $product->description = $values['description'];
            $product->cost_price = $values['cost_price'];
            $product->regular_price = $values['regular_price'];
            $product->discount = $values['discount'];
            if (!empty($values['discount'])) {
                $product->sale_price = $values['regular_price'] * (1 - $values['discount'] / 100);
                $product->selling_price = round($product->sale_price, -3);
            } else {
                $product->sale_price = null;
                $product->selling_price = $values['regular_price'];
            }
            $product->SKU = null;
            $product->image = $values['image'];
            $product->images = $values['images'];
            if (!empty($values['related_product'])) {
                $product->related_product = $values['related_product'];
            } else {
                $product->related_product = null;
            }
            $product->trademark_id = $values['trademark_id'];
            if (!empty($values['quantity'])) {
                $product->quantity = $values['quantity'];
            }
            if (!empty($values['hide'])) {
                $product->hide = $values['hide'];
            }
            if (!empty($values['is_feature'])) {
                $product->is_feature = $values['is_feature'];
            }
            $product->created_at = date('Y-m-d H:m:s');
            $product->updated_at = date('Y-m-d H:m:s');
            $product->admin_id = $values['admin_id'];
            if ($product->save()) {
                $countProduct++;
            }
        }
        echo "Inserted " . $countProduct . '/' . count(self::$productInforArr) . ' products.' . PHP_EOL;
    }

    protected static $productAssocInfoArr = [
        [
            'product_id' => '1',
            'type_id' => '2',
            'category_id' => '2',
            'color_id' => '1,2',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '2',
            'type_id' => '2',
            'category_id' => '2',
            'color_id' => '1,2',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '3',
            'type_id' => '2',
            'category_id' => '2',
            'color_id' => '1,2',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '4',
            'type_id' => '2',
            'category_id' => '2',
            'color_id' => '1,2',
            'size_id' => '3,4,5,6,7',
            'admin_id' => 1,
        ],
        [
            'product_id' => '5',
            'type_id' => '2',
            'category_id' => '2',
            'color_id' => '1,2,6',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '6',
            'type_id' => '2,4',
            'category_id' => '1',
            'color_id' => '1,6,7',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '7',
            'type_id' => '2,4',
            'category_id' => '3',
            'color_id' => '2,11,12',
            'size_id' => '3,4,5,6',
            'admin_id' => 1,
        ],
        [
            'product_id' => '8',
            'type_id' => '4,5',
            'category_id' => '4',
            'color_id' => '3,7',
            'size_id' => '8,9,10',
            'admin_id' => 1,
        ],
        [
            'product_id' => '9',
            'type_id' => '4,5',
            'category_id' => '4',
            'color_id' => '7',
            'size_id' => '8,9,10',
            'admin_id' => 1,
        ],
        [
            'product_id' => '10',
            'type_id' => '2,4',
            'category_id' => '4',
            'color_id' => '8,14',
            'size_id' => '8,9,10',
            'admin_id' => 1,
        ],
    ];

    public static function insertSampleProductAssoc()
    {
        $countAssoc = 0;
        foreach (self::$productAssocInfoArr as $values) {
            $assoc = new ProductAssoc();
            $assoc->product_id = $values['product_id'];
            $assoc->type_id = $values['type_id'];
            $assoc->category_id = $values['category_id'];
            if (!empty($values['color_id'])) {
                $assoc->color_id = $values['color_id'];
            }
            if (!empty($values['size_id'])) {
                $assoc->size_id = $values['size_id'];
            }
            $assoc->created_at = date('Y-m-d H:m:s');
            $assoc->updated_at = date('Y-m-d H:m:s');
            $assoc->admin_id = $values['admin_id'];
            if ($assoc->save()) {
                $countAssoc++;
            }
        }
        echo "Inserted " . $countAssoc . '/' . count(self::$productAssocInfoArr) . ' product assoc.' . PHP_EOL;
    }

    /**
     *  product category data
     * @var array[]
     */
    protected static $productCategoryInfoArr = [
        [
            'name' => 'Áo thun',
            'slug' => 'ao-thun',
            'type_id' => '2',
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo Vest',
            'slug' => 'ao-vest',
            'type_id' => '2,4',
            'admin_id' => 1,
        ],
        [
            'name' => 'Quần âu',
            'slug' => 'quan-au',
            'type_id' => '4,5',
            'admin_id' => 1,
        ],
        [
            'name' => 'Dây lưng',
            'slug' => 'day-lung',
            'type_id' => '3,4',
            'admin_id' => 1,
        ],
        [
            'name' => 'Giày',
            'slug' => 'giay',
            'type_id' => '3,4',
            'admin_id' => 1,
        ],
    ];

    /**
     *
     */
    public static function insertSampleProductCategory()
    {
        $countCategory = 0;
        foreach (self::$productCategoryInfoArr as $values) {
            $category = new ProductCategory();
            $category->name = $values['name'];
            $category->slug = $values['slug'];
            $category->type_id = $values['type_id'];
            $category->created_at = date('Y-m-d H:m:s');
            $category->updated_at = date('Y-m-d H:m:s');
            $category->admin_id = $values['admin_id'];
            if ($category->save()) {
                $countCategory++;
            }
        }
        echo "Inserted " . $countCategory . '/' . count(self::$productCategoryInfoArr) . ' product categories.' . PHP_EOL;
    }

    /**
     * @var \string[][]
     */
    protected static $arrProductType = [
        [
            'name' => 'New arrival',
            'slug' => 'new-arrival',
            'image' => 'type/brand2.jpg',
            'shop_show' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Tailor-made',
            'slug' => 'tailor-made',
            'image' => 'type/gift.jpg',
            'segment' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Collections',
            'slug' => 'mix-and-match',
            'image' => 'type/gift.jpg',
            'segment' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Áo sơ mi',
            'slug' => 'ao-so-mi',
            'image' => 'type/vest-nam-den.jpg',
            'shop_show' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Quần',
            'slug' => 'quan',
            'image' => 'type/quan-tay-ong-rong.jpg',
            'shop_show' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Phụ kiện',
            'slug' => 'phu-kien',
            'image' => 'type/GLT_1219.jpeg',
            'shop_show' => 1,
            'admin_id' => 1,
        ],
        [
            'name' => 'Quà tặng',
            'slug' => 'qua-tang',
            'image' => 'type/gift.jpg',
            'shop_show' => 1,
            'admin_id' => 1,
        ],
    ];

    /**
     *
     */
    public static function insertSampleProductType()
    {
        $countType = 0;
        foreach (self::$arrProductType as $value) {
            $model = new ProductType();
            $model->name = $value['name'];
            $model->slug = $value['slug'];
            $model->image = $value['image'];
            if (!empty($value['shop_show'])) {
                $model->shop_show = $value['shop_show'];
            }
            if (!empty($value['segment'])) {
                $model->segment = $value['segment'];
            }
            $model->admin_id = $value['admin_id'];
            $model->created_at = date('Y-m-d H:m:s');
            $model->updated_at = date('Y-m-d H:m:s');
            if ($model->save()) {
                $countType++;
            }
        }
        echo "Inserted " . $countType . '/' . count(self::$arrProductType) . ' product types.' . PHP_EOL;
    }

    /**
     *  trademark data
     * @var array[]
     */
    protected static $trademarkInfoArr = [
        [
            'name' => 'HUGO',
            'slug' => 'hugo',
            'admin_id' => 1,
        ],
        [
            'name' => 'LADOS',
            'slug' => 'lados',
            'admin_id' => 1,
        ],
        [
            'name' => 'The Shirt Studio',
            'slug' => 'the-shirt-studio',
            'admin_id' => 1,
        ],
    ];

    /**
     *
     */
    public static function insertSampleTrademark()
    {
        $countTrademark = 0;
        foreach (self::$trademarkInfoArr as $values) {
            $trademark = new Trademark();
            $trademark->name = $values['name'];
            $trademark->slug = $values['slug'];
            $trademark->created_at = date('Y-m-d H:m:s');
            $trademark->updated_at = date('Y-m-d H:m:s');
            $trademark->admin_id = $values['admin_id'];
            if ($trademark->save()) {
                $countTrademark++;
            }
        }
        echo "Inserted " . $countTrademark . '/' . count(self::$trademarkInfoArr) . ' trademarks.' . PHP_EOL;
    }

    /**
     *  post data
     * @var array[]
     */
    protected static $postInfoArr = [
        [
            'avatar' => 'post/avatar/winter-fashion.jpg',
            'title' => 'De Obelly Collections 2021 - Lựa chọn hoàn hảo cho mùa hè',
            'slug' => 'de-obelly-collections-2021-lua-chon-hoan-hao-cho-mua-he',
            'content' => '<p>FashionTEA - Polo - Trang phục kinh điển của cánh mày râu. Tận hưởng mùa hè mát lạnh
                                với những chiếc áo Polo đa sắc màu trong BST Hè DE OBELLY 2021. Hãy check ngay những mẫu
                                 Hot nhất trong tuần qua nhé</p><p>Áo polo được bắt nguồn từ bang Manipur của Ấn Độ
                                 - nơi khởi nguồn của môn polo (bóng khúc cầu trên lưng ngựa). Những người lính thực dân
                                 Anh đã mang trò chơi này về quê hương và biến nó thành môn thể thao quý tộc ở Anh vào cuối
                                  thế kỷ 19. Thiết kế nguyên bản của áo Polo là dáng dài tay thay vì ngắn tay như ngày nay.</p>
                                  <p>Khi Lacoste lần đầu mặc trang phục này đến giải quần vợt US Open 1926 và giành chức vô địch,
                                  nó lập tức trở thành một hiện tượng thời trang. Đây là một trang phục đơn giản dành cho mọi nam giới,
                                   đã có lịch sử tông tại gần 100 năm, không có sự phân biệt giàu nghèo, cao thấp trong văn hóa mặc của đàn ông.
                                   Cùng với nhiều ưu điểm vượt trội từ áo phông có cổ mang đến cho người mặc.</p>
                                   <p>Áo có form ôm người nhưng vẫn tôn lên các đường nét vạm vỡ, săn chắc của phái mạnh</p>
                                    <p>Thiết kế hội tụ đầy đủ tính ưu việt, vượt trội hơn hẳn "người anh em" sơ mi</p>
                                    <p>Phong cách thể thao, nam tính và năng động, trẻ trung là điều mà bất kỳ người đàn ông nào cũng muốn hướng đến</p>
                                    <p>Chất liệu co giãn tốt, thoáng mát, thấm hút mồ hôi cho người mặc vận động thoải mái</p>
                                    <p>Gam màu đa dạng, dễ dàng mix cùng nhiều trang phục mà vẫn giữ được lịch lãm, cổ điển không bao giờ lỗi mốt</p>
                                    <p>Nếu bạn một tín đồ của áo polo, hãy lựa ngay items mình yêu thích và đặt hàng ngay tại Biluxury!</p>',
            'admin_id' => 2,
            'tag_id' => '1,2,5',
            'post_category_id' => 7,
        ],
        [
            'avatar' => 'post/avatar/winter-fashion.jpg',
            'title' => 'Cực chất với bộ sưu tập mùa hè',
            'slug' => 'cuc-chat-voi-bo-suu-tap-mua-he',
            'content' => '<p>FashionTEA - Polo - Trang phục kinh điển của cánh mày râu. Tận hưởng mùa hè mát lạnh
                                với những chiếc áo Polo đa sắc màu trong BST Hè DE OBELLY 2021. Hãy check ngay những mẫu
                                 Hot nhất trong tuần qua nhé</p><p>Áo polo được bắt nguồn từ bang Manipur của Ấn Độ
                                 - nơi khởi nguồn của môn polo (bóng khúc cầu trên lưng ngựa). Những người lính thực dân
                                 Anh đã mang trò chơi này về quê hương và biến nó thành môn thể thao quý tộc ở Anh vào cuối
                                  thế kỷ 19. Thiết kế nguyên bản của áo Polo là dáng dài tay thay vì ngắn tay như ngày nay.</p>
                                  <p>Khi Lacoste lần đầu mặc trang phục này đến giải quần vợt US Open 1926 và giành chức vô địch,
                                  nó lập tức trở thành một hiện tượng thời trang. Đây là một trang phục đơn giản dành cho mọi nam giới,
                                   đã có lịch sử tông tại gần 100 năm, không có sự phân biệt giàu nghèo, cao thấp trong văn hóa mặc của đàn ông.
                                   Cùng với nhiều ưu điểm vượt trội từ áo phông có cổ mang đến cho người mặc.</p>
                                   <p>Áo có form ôm người nhưng vẫn tôn lên các đường nét vạm vỡ, săn chắc của phái mạnh</p>
                                    <p>Thiết kế hội tụ đầy đủ tính ưu việt, vượt trội hơn hẳn "người anh em" sơ mi</p>
                                    <p>Phong cách thể thao, nam tính và năng động, trẻ trung là điều mà bất kỳ người đàn ông nào cũng muốn hướng đến</p>
                                    <p>Chất liệu co giãn tốt, thoáng mát, thấm hút mồ hôi cho người mặc vận động thoải mái</p>
                                    <p>Gam màu đa dạng, dễ dàng mix cùng nhiều trang phục mà vẫn giữ được lịch lãm, cổ điển không bao giờ lỗi mốt</p>
                                    <p>Nếu bạn một tín đồ của áo polo, hãy lựa ngay items mình yêu thích và đặt hàng ngay tại Biluxury!</p>',
            'admin_id' => 2,
            'tag_id' => '2,6,8',
            'post_category_id' => 7,
        ],
        [
            'avatar' => 'post/avatar/winter-fashion.jpg',
            'title' => 'Community And Style Thrived at the Santa Fe Indian Market',
            'slug' => 'community—and-style—thrived-at-the-santa-fe-indian-market',
            'content' => '<p>Every year, the Santa Fe Indian Market brings in thousands of global tourists and collectors to the city. 
                         Visitors flock to the streets around the city’s main plaza, 
                         where hundreds of Indigenous artists from different tribes across North America showcase and sell their new works 
                         (including textiles, jewelry, art, and more) in their respective booths. 
                         This weekend, the 99th annual outdoor market returned once again, and the sense of community was as present as ever. 
                         While overall attendance was down (the typically free event was ticketed this year due to COVID) and the number of artists showcasing was fewer than usual, 
                         you could still feel the energy and excitement around the event. 
                         The streets were still lined with excited shoppers perusing the latest goods, 
                         and booths were filled with artists visiting each other and having a laugh—masks up, of course.</p>
                        <p>Indian Market weekend is a big tourism event for the city, but the occasion represents something much more important for the participating artists and artisans. Business aside, it’s a time for the Native American community to come back together, visit with friends and family, and get inspired by each other’s creativity. And this year, after a canceled 2020 event and a long time apart due to COVID-19, that spirit of connection was needed more than ever. “There is nothing like interacting with fellow creatives in person,” says Jamie Okuma, a Luiseño and Shoshone-Bannock fashion artist who showcased her new collection at the market’s fashion show this weekend. “Meeting collectors and enjoying being in the presence of other humans outside of family was something I really didn’t realize I needed. As an artist, I’m naturally isolated by profession, so the few shows I do in person are extremely important for my mental health. When those were gone, it was pretty rough.”</p>
                        <p>Last year, the Santa Fe Indian Market was held virtually, and for many artists, that meant a considerable loss of income. Sales at the fair make up a significant portion of their yearly incomes, as a single piece can go for thousands of dollars. For all these reasons, the Indigenous artists were counting on the continuation of this year’s event. “There was a lot of trepidation leading up to it, with the delta variant looming overhead and the state of New Mexico’s mandates ever changing,” says Pat Pruitt, a Laguna, Chiricahua Apache, and Anglo metalsmith and jewelry designer. “But it was good to see friends, family, and collectors.”</p>
                        <p>Though there were fewer visitors, many artists still did surprisingly well in sales; it seems shoppers were ready to spend. For instance, Naiomi Glasses—a Diné textile artist and first-time shower at the market—says she got many future rug orders from the event and looks forward to returning next year for its centennial year. “As a working artist, the market is important so that I could meet new and current customers in person. It gives them and me a personable connection,” says Glasses. </p>
                        <p>Along with a clear sense of togetherness, there was also major style present throughout the weekend—whether it was worn by visitors or artists on the streets or shown on the runway for the market’s annual fashion show, which was organized by Amber-Dawn Bear Robe. </p>
                        <p>Around the booths, visitors and artists alike dressed up for the affair, cladding themselves in their best ribbon skirts or turquoise squash-blossom necklaces. At the fashion show, Indigenous designers Jamie Okuma, Orlando Dugi, Pamela Baker, and Lauren Good Day showcased their newest collections, pieces that combined traditional craftsmanship with new, modern updates. Dugi and Baker showed refined eveningwear pieces like beaded gowns and velvet suiting, while Okuma opted for her signature statement prints on dresses, coats, and more. Good Day even showed sprightly athleticwear—the through line being that Native design doesn’t have to look one specific way. For all in attendance, that sense of innovation is forever an Indian Market staple. “The energy was palpable,” says Pruitt. “Spirits were high, and in the end, the machine that is Indian Market just keeps on going.”</p>
                        <p>Below, more stylish highlights from the Santa Fe Indian Market weekend.</p>',
            'admin_id' => 2,
            'tag_id' => '1,4,5',
            'post_category_id' => 4,
        ],
        [
            'avatar' => 'post/avatar/winter-fashion.jpg',
            'title' => '4 "cặp đôi" trang phục cho chàng phong cách ngày hè',
            'slug' => '4-cap-doi-trang-phuc-cho-chang-phong-cach-mua-he',
            'content' => '<p>FashionTEA - Polo - Trang phục kinh điển của cánh mày râu. Tận hưởng mùa hè mát lạnh
                                với những chiếc áo Polo đa sắc màu trong BST Hè DE OBELLY 2021. Hãy check ngay những mẫu
                                 Hot nhất trong tuần qua nhé</p><p>Áo polo được bắt nguồn từ bang Manipur của Ấn Độ
                                 - nơi khởi nguồn của môn polo (bóng khúc cầu trên lưng ngựa). Những người lính thực dân
                                 Anh đã mang trò chơi này về quê hương và biến nó thành môn thể thao quý tộc ở Anh vào cuối
                                  thế kỷ 19. Thiết kế nguyên bản của áo Polo là dáng dài tay thay vì ngắn tay như ngày nay.</p>
                                  <p>Khi Lacoste lần đầu mặc trang phục này đến giải quần vợt US Open 1926 và giành chức vô địch,
                                  nó lập tức trở thành một hiện tượng thời trang. Đây là một trang phục đơn giản dành cho mọi nam giới,
                                   đã có lịch sử tông tại gần 100 năm, không có sự phân biệt giàu nghèo, cao thấp trong văn hóa mặc của đàn ông.
                                   Cùng với nhiều ưu điểm vượt trội từ áo phông có cổ mang đến cho người mặc.</p>
                                   <p>Áo có form ôm người nhưng vẫn tôn lên các đường nét vạm vỡ, săn chắc của phái mạnh</p>
                                    <p>Thiết kế hội tụ đầy đủ tính ưu việt, vượt trội hơn hẳn "người anh em" sơ mi</p>
                                    <p>Phong cách thể thao, nam tính và năng động, trẻ trung là điều mà bất kỳ người đàn ông nào cũng muốn hướng đến</p>
                                    <p>Chất liệu co giãn tốt, thoáng mát, thấm hút mồ hôi cho người mặc vận động thoải mái</p>
                                    <p>Gam màu đa dạng, dễ dàng mix cùng nhiều trang phục mà vẫn giữ được lịch lãm, cổ điển không bao giờ lỗi mốt</p>
                                    <p>Nếu bạn một tín đồ của áo polo, hãy lựa ngay items mình yêu thích và đặt hàng ngay tại Biluxury!</p>',
            'admin_id' => 2,
            'tag_id' => '3,8,1',
            'post_category_id' => 3,
        ],
    ];

    /**
     *
     */
    public static function insertSamplePost()
    {
        $countPost = 0;
        foreach (self::$postInfoArr as $value) {
            $post = new Post();
            $post->avatar = $value['avatar'];
            $post->title = $value['title'];
            $post->slug = $value['slug'];
            $post->content = $value['content'];
            $post->admin_id = $value['admin_id'];
            $post->tag_id = $value['tag_id'];
            $post->post_category_id = $value['post_category_id'];
            $post->created_at = date('Y-m-d H:m:s');
            $post->updated_at = date('Y-m-d H:m:s');
            if ($post->save()) {
                $countPost++;
            }
        }
        echo "Inserted " . $countPost . "/" . count(self::$postInfoArr) . ' post.' . PHP_EOL;
    }

    /**
     * @var array|array[]
     */
    protected static $termsInfoArr = [
        [
            'title' => ' ĐIỀU KHOẢN CỬA HÀNG TRỰC TUYẾN',
            'content' => '<p>- Bằng việc đồng ý các Điều Khoản Dịch Vụ, bạn xác nhận rằng ít nhất bạn trong độ tuổi trưởng thành ở khu vực mà bạn đang sống và bạn đã cho chúng tôi sự đồng ý của bạn để cho phép bất kỳ người phụ thuộc của bạn sử dụng trang này.<br>- Bạn có thể không sử dụng sản phẩm của chúng tôi khi có bất kỳ sự trái luật hoặc có ý định lạm dụng hay không trong khi sử dụng Dịch Vụ, vi phạm bất kỳ luật lệ nào trong quyền hạn của bạn (bao gồm nhưng không giới hạn quy định pháp luật).<br>- Bạn không được truyền bất kỳ sâu hoặc virus hoặc bất kỳ mã nào có tính chất phá hoại.<br>- Một sự vi phạm hoặc làm trái bất kỳ Điều Khoản nào sẽ dẫn đến việc chấm dứt ngay Dịch Vụ.</p>',
            'admin_id' => 1,
        ],
        [
            'title' => ' ĐIỀU KIỆN CHUNG',
            'content' => '<p>- Chúng tôi có quyền từ chối dịch vụ đối với bất kỳ ai với bất kỳ lý do vào bất kỳ thời điểm nào.<br>- Bạn hiểu rằng thông tin của bạn (không bao gồm thông tin thẻ tín dụng), có thể được chuyển không mã hóa và bao gồm (a) việc truyền qua các mạng liên kết khác nhau; và (b) thay đổi để phù hợp và thích ứng với các yêu cầu kỹ thuật của kết nối mạng hoặc thiết bị.<br>- Thông tin thẻ tín dụng sẽ luôn chuyển nguyên bản thành mật mã trong khi chuyển qua mạng.<br>- Bạn đồng ý không tạo lại, sao chép, bán, bán lại hoặc khai thác bất kỳ phần nào của Dịch Vụ, sử dụng Dịch Vụ, hoặc truy cập Dịch Vụ hoặc bất kỳ liên hệ nào trên trang web mà dịch vụ được cung cấp không có sự cho phép rõ ràng bằng văn bản của chúng tôi.<br>- Các mục được sử dụng trong thỏa thuận này chỉ gồm cho sự thuận tiện và sẽ không giới hạn hoặc ảnh hưởng đến các Điều Khoản.</p>',
            'admin_id' => 1,
        ],
        [
            'title' => 'ĐỘ  CHÍNH XÁC, ĐẦY ĐỦ VÀ THÔNG TIN KỊP THỜI',
            'content' => '<p>- Bạn không chịu trách nhiệm nếu thông tin được được có sẵn trên trang web không chính xác, đầy đủ hoặc hiện thời. <br>- Tài liệu trên trang web được cung cấp với thông tin chung và không nên dựa vào hoặc sử dụng hoặc sử dụng làm cơ sở để đưa ra quyết định mà không tham khảo các nguồn thông tin chính, chính xác hơn, đầy đủ hơn hoặc kịp thời hơn.<br>- Bất kỳ sự phụ thuộc nào vào tài liệu trên trang web này đều có rủi ro cho bạn.<br>- Trang web này có thể bao gồm những thông tin lịch sử nhất định. Thông tin lịch sử, tất yếu, không ở hiện tại và chỉ được cung cấp cho bạn tham khảo.<br>- Chúng tôi có quyền sửa đổi nội dung của trang web này bất cứ lúc nào, nhưng chúng tôi không có nghĩa vụ phải cập nhật bất kỳ thông tin nào trên trang web của chúng tôi.<br>- Bạn đồng ý rằng bạn có trách nhiệm theo dõi các thay đổi đối với trang web của chúng tôi.</p>',
            'admin_id' => 1,
        ],
        [
            'title' => 'SỬA ĐỔI DỊCH VỤ VÀ GIÁ CẢ',
            'content' => '<p>- Giá các sản phẩm của chúng tôi có thể thay đổi mà không cần thông báo trước. <br>- Chúng tôi có quyền bảo lưu bất cứ lúc nào để sửa đổi hoặc ngừng Dịch Vụ (hoặc bất cứ phần nào hoặc nội dung của nó) không cần thông báo.<br>- Chúng tôi sẽ không chịu trách nhiệm với bạn hoặc bất kỳ bên thứ ba về bất cứ sửa đổi nào, thay đổi giá, hệ thống treo hoặc dừng Dịch Vụ.</p>',
            'admin_id' => 1,
        ],
        [
            'title' => 'SẢN PHẨM',
            'content' => '<p>- Một số sản phẩm nào đó có thể có sẳn dành riêng cho trực tuyến thông qua trang web này.<br>- Những sản phẩm hoặc dịch vụ này có thể có giới hạn số lượng và vấn đề trả hàng hoặc đổi hàng chỉ tùy theo Chính Sách Trả Hàng của chúng tôi.<br>- Chúng tôi đã làm mọi cố gắng để hiển thị chính xác nhất có thể về màu sắc và hình ảnh sản phẩm của chúng tôi luôn hiện ra cửa hàng.<br>- Chúng tôi có quyền, nhưng không bắt buộc, giới hạn việc bán sản phẩm của chúng tôi hoặc Dịch Vụ cho bất cứ ai, vùng lãnh thổ hoặc thẩm quyền.  <br>- Chúng tôi có thể thực hiện quyền này trên cơ sở từng trường hợp.<br>- Hầu hết diễn giải về những sản phẩm hoặc giá đang áp dụng có thể thay đổi bất cứ lúc nào mà không cần thông báo, theo quyết định riêng của chúng tôi.<br>- Chúng tôi có quyền dừng bất kỳ sản phẩm nào vào bất kỳ thời điểm nào.<br>- Bất kỳ đề nghị cho bất kỳ sản phẩm nào trên trang web này là vô hiệu khi bị cấm.<br>- Chúng tôi không cho phép chất lượng, dịch vụ, thông tin của bất kỳ sản phẩm nào hoặc đơn đặt vật liệu hoặc thu được không đáp ứng kỳ vọng của bạn hoặc bất kỳ lỗi trong Dịch Vụ sẽ được sửa chữa.</p>',
            'admin_id' => 1,
        ],
        [
            'title' => 'CHÍNH XÁC THÔNG TIN HÓA ĐƠN VÀ TÀI KHOẢN',
            'content' => '<p>- Chúng tôi có quyền từ chối bất kỳ đơn hàng nào từ bạn.<br>- Chúng tôi có thể, theo quyết định riêng của chúng tôi, giới hạn hoặc hủy số lượng mua cho mỗi công ty, mỗi người, mỗi hộ gia đình hoặc mỗi đơn hàng.</p>',
            'admin_id' => 1,
        ],
    ];

    /**
     *
     */
    public static function insertSampleTerms()
    {
        $countTerms = 0;
        foreach (self::$termsInfoArr as $value) {
            $terms = new Terms();
            $terms->title = $value['title'];
            $terms->content = $value['content'];
            $terms->admin_id = $value['admin_id'];
            $terms->created_at = date('Y-m-d H:m:s');
            $terms->updated_at = date('Y-m-d H:m:s');
            if ($terms->save()) {
                $countTerms++;
            }
        }
        echo "Inserted " . $countTerms . '/' . count(self::$termsInfoArr) . ' terms.' . PHP_EOL;
    }

    /**
     * @var array|string[][]
     */
    protected static $postTagInfoArr = [
        [
            'title' => 'Street style',
            'slug' => 'street-style',
        ],
        [
            'title' => 'Trends',
            'slug' => 'trends',
        ],
        [
            'title' => 'Shopping tips',
            'slug' => 'shopping-tips',
        ],
        [
            'title' => 'Beauty',
            'slug' => 'beauty',
        ],
        [
            'title' => 'Office style',
            'slug' => 'office-style',
        ],
        [
            'title' => 'White collar',
            'slug' => 'white-collar',
        ],
        [
            'title' => 'Spring',
            'slug' => 'spring',
        ],
        [
            'title' => 'Summer',
            'slug' => 'summer',
        ],
        [
            'title' => 'Autumn',
            'slug' => 'autumn',
        ],
        [
            'title' => 'Winter',
            'slug' => 'winter',
        ],
    ];

    /**
     *
     */
    protected static function insertSamplePostTag()
    {
        $countTag = 0;
        foreach (self::$postTagInfoArr as $value) {
            $postTag = new PostTag();
            $postTag->title = $value['title'];
            $postTag->slug = $value['slug'];
            $postTag->created_at = date('Y-m-d H:m:s');
            $postTag->updated_at = date('Y-m-d H:m:s');
            if ($postTag->save()) {
                $countTag++;
            }
        }
        echo "Inserted " . $countTag . '/' . count(self::$postTagInfoArr) . ' post tag.' . PHP_EOL;
    }

    /**
     * @var \string[][]
     */
    protected static $postCategoryInfoArr = [
        [
            'title' => 'Fashion Design',
            'slug' => 'fashion-design',
        ],
        [
            'title' => 'Fashion Designers',
            'slug' => 'fashion-designers',
        ],
        [
            'title' => 'Fashion Events',
            'slug' => 'fashion-events',
        ],
        [
            'title' => 'Fashion Week',
            'slug' => 'fashion-week',
        ],
        [
            'title' => 'Fashion News',
            'slug' => 'fashion-news',
        ],
        [
            'title' => 'Fashion Technology',
            'slug' => 'fashion-technology',
        ],
        [
            'title' => 'Fashion Brand',
            'slug' => 'fashion-brand',
        ],
        [
            'title' => 'Uncategorized',
            'slug' => 'uncategorized',
        ],
    ];

    /**
     *
     */
    protected static function insertSamplePostCategory()
    {
        $countPostCate = 0;
        foreach (self::$postCategoryInfoArr as $value) {
            $postCate = new PostCategory();
            $postCate->title = $value['title'];
            $postCate->slug = $value['slug'];
            $postCate->created_at = date('Y-m-d H:m:s');
            $postCate->updated_at = date('Y-m-d H:m:s');
            if ($postCate->save()) {
                $countPostCate++;
            }
        }
        echo "Inserted " . $countPostCate . '/' . count(self::$postCategoryInfoArr) . ' post category.' . PHP_EOL;
    }

    /**
     * @var array[]
     */
    protected static $arrCartInfo = [
        [
            'user_id' => 4,
            'product_id' => '7',
            'color_id' => 1,
            'size_id' => 6,
            'quantity' => 3,
        ],
        [
            'user_id' => 4,
            'product_id' => '3',
            'color_id' => 4,
            'size_id' => 3,
            'quantity' => 4,
        ],
        [
            'user_id' => 4,
            'product_id' => '5',
            'color_id' => 2,
            'size_id' => 5,
            'quantity' => 2,
        ],
    ];

    /**
     *
     */
    protected static function insertSampleCart()
    {
        $countCart = 0;
        foreach (self::$arrCartInfo as $value) {
            $cart = new Cart();
            $cart->user_id = $value['user_id'];
            $cart->product_id = $value['product_id'];
            if (!empty($value['color_id'])) {
                $cart->color_id = $value['color_id'];
            }
            if (!empty($value['size_id'])) {
                $cart->size_id = $value['size_id'];
            }
            $cart->quantity = $value['quantity'];
            $cart->total_price = $value['quantity'] * \frontend\models\Product::getPriceProductById($value['product_id']);
            $cart->created_at = date('Y-m-d H:m:s');
            $cart->updated_at = date('Y-m-d H:m:s');
            if ($cart->save()) {
                $countCart++;
            }
        }
        echo "Inserted " . $countCart . '/' . count(self::$arrCartInfo) . ' carts.' . PHP_EOL;
    }

    /**
     * @var array[]
     */
    protected static $arrOrderInfo = [
        [
            'user_id' => 4,
            'product_id' => '7',
            'color_id' => 1,
            'size_id' => 6,
            'quantity' => 3,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '128A Hồ Tùng Mậu',
            'tel' => '0334517566',
            'name' => 'Hoàng Thị Lý',
            'email' => 'hoangly94@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 0,
        ],
        [
            'user_id' => 4,
            'product_id' => '8',
            'color_id' => 1,
            'size_id' => 5,
            'quantity' => 1,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '128A Hồ Tùng Mậu',
            'tel' => '0334517566',
            'name' => 'Hoàng Thị Lý',
            'email' => 'hoangly94@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 0,
        ],
        [
            'user_id' => 4,
            'product_id' => '5',
            'color_id' => 2,
            'size_id' => 6,
            'quantity' => 6,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '128A Hồ Tùng Mậu',
            'tel' => '0334517566',
            'name' => 'Hoàng Thị Lý',
            'email' => 'hoangly94@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 0,
        ],
        [
            'user_id' => 4,
            'product_id' => '3',
            'color_id' => 2,
            'size_id' => 4,
            'quantity' => 1,
            'tel' => '0334517566',
            'name' => 'Hoàng Thị Lý',
            'email' => 'hoangly94@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 1,
        ],
        [
            'user_id' => 5,
            'product_id' => '8',
            'color_id' => 2,
            'size_id' => 5,
            'quantity' => 1,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '37C1 Ngõ 20',
            'tel' => '0334517566',
            'name' => 'Hoàng Thị Lý',
            'email' => 'hoangly94@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 0,
        ],
        [
            'user_id' => 5,
            'product_id' => '6',
            'color_id' => 2,
            'size_id' => 3,
            'quantity' => 2,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '37C1 Ngõ 20',
            'tel' => '0394548299',
            'name' => 'Nguyễn Văn Sơn',
            'email' => 'vanson246@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 1,
        ],
        [
            'user_id' => 5,
            'product_id' => '8',
            'color_id' => 2,
            'size_id' => 6,
            'quantity' => 1,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '37C1 Ngõ 20',
            'tel' => '0394548299',
            'name' => 'Nguyễn Văn Sơn',
            'email' => 'vanson246@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 1,
        ],
        [
            'user_id' => 5,
            'product_id' => '4',
            'color_id' => 2,
            'size_id' => 6,
            'quantity' => 1,
            'province_id' => 1,
            'district_id' => 63,
            'village_id' => 60,
            'specific_address' => '105 Doãn Kế Thiện',
            'tel' => '0394548299',
            'name' => 'Nguyễn Văn Sơn',
            'email' => 'vanson246@gmail.com',
            'admin_id' => 1,
            'logistic_method' => 1,
        ],
    ];

    /**
     *
     */
    protected static function insertSampleOrder()
    {
        $countOrder = 0;
        foreach (self::$arrOrderInfo as $value) {
            $order = new Order();
            $order->BL_code = 'DE'.date('YmdHis').chr(rand(97,122)).rand(1,9);
            $order->user_id = $value['user_id'];
            $order->product_id = $value['product_id'];
            if (!empty($value['color_id'])) {
                $order->color_id = $value['color_id'];
            }
            if (!empty($value['size_id'])) {
                $order->size_id = $value['size_id'];
            }
            $order->quantity = $value['quantity'];
            if ($value['logistic_method'] == 0) {
                $order->province_id = $value['province_id'];
                $order->district_id = $value['district_id'];
                $order->village_id = $value['village_id'];
                $order->specific_address = $value['specific_address'];
                $order->address = $value['specific_address'] . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($value['village_id']) . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($value['district_id']) . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($value['province_id']);
            }
            $order->tel = $value['tel'];
            $order->name = $value['name'];
            $order->email = $value['email'];
            $order->admin_id = $value['admin_id'];
            $order->logistic_method = $value['logistic_method'];
            $order->created_at = date('Y-m-d H:m:s');
            $order->updated_at = date('Y-m-d H:m:s');
            $order->status = rand(1, 8);
            if ($order->save(false)) {
                $countOrder++;
            }
        }
        echo "Inserted " . $countOrder . '/' . count(self::$arrOrderInfo) . ' orders.' . PHP_EOL;
    }

    /**
     * @var array[]
     */
    protected static $arrOrderTrackingInfo = [
        [
            'order_id' => 1,
            'admin_id' => '1',
            'action' => 4,
        ],
        [
            'order_id' => 2,
            'admin_id' => '1',
            'action' => 4,
        ],
        [
            'order_id' => 3,
            'admin_id' => '1',
            'action' => 5,
        ],
        [
            'order_id' => 4,
            'admin_id' => '1',
            'action' => 0,
        ],
        [
            'order_id' => 5,
            'admin_id' => '1',
            'action' => 4,
        ],
        [
            'order_id' => 6,
            'admin_id' => '1',
            'action' => 5,
        ],
        [
            'order_id' => 7,
            'admin_id' => '1',
            'action' => 10,
        ],
        [
            'order_id' => 8,
            'admin_id' => '1',
            'action' => 1,
        ],
    ];

    /**
     *
     */
    protected static function insertSampleOrderTracking()
    {
        $countOrderTracking = 0;
        foreach (self::$arrOrderTrackingInfo as $value) {
            $orderTracking = new OrderTracking();
            $orderTracking->order_id = $value['order_id'];
            $orderTracking->admin_id = $value['admin_id'];
            $orderTracking->action = $value['action'];
            $orderTracking->created_at = date('Y-m-d H:m:s');
            $orderTracking->updated_at = date('Y-m-d H:m:s');
            if ($orderTracking->save()) {
                $countOrderTracking++;
            }
        }
        echo "Inserted " . $countOrderTracking . '/' . count(self::$arrOrderTrackingInfo) . ' order tracking.' . PHP_EOL;
    }

    protected static $arrTrackingStatus = [
        'New',
        'Processing',
        'Approved',
        'Shipping',
        'Delivered',
        'Cancelled',
        'Expired',
        'Refunded',
        'Postpone',
        'Rejected',
        'Failed',
    ];

    public static function insertSampleTrackingStatus()
    {
        $count = 0;
        foreach (self::$arrTrackingStatus as $status) {
            $model = new TrackingStatus();
            $model->name = $status;
            $model->slug = StringHelper::toSlug($status);
            $model->admin_id = 1;
            $model->created_at = date('Y-m-d H:m:s');
            $model->updated_at = date('Y-m-d H:m:s');
            if ($model->save()) {
                $count++;
            }
        }
        echo "Inserted " . $count . '/' . count(self::$arrTrackingStatus) . ' tracking status.' . PHP_EOL;
    }

    protected static $arrWardDistrictProvince = [
        'Thành phố Hà Nội' => [
            'Quận Ba Đình' => 'Phường Phúc Xá,Phường Trúc Bạch,Phường Vĩnh Phúc,Phường Cống Vị,Phường Liễu Giai,Phường Nguyễn Trung Trực,Phường Quán Thánh,Phường Ngọc Hà,Phường Điện Biên,Phường Đội Cấn,Phường Ngọc Khánh,Phường Kim Mã,Phường Giảng Võ,Phường Thành Công',
            'Quận Hoàn Kiếm' => 'Phường Phúc Tân,Phường Đồng Xuân,Phường Hàng Mã,Phường Hàng Buồm,Phường Hàng Đào,Phường Hàng Bồ,Phường Cửa Đông,Phường Lý Thái Tổ,Phường Hàng Bạc,Phường Hàng Gai,Phường Chương Dương,Phường Hàng Trống,Phường Cửa Nam,Phường Hàng Bông,Phường Tràng Tiền,Phường Trần Hưng Đạo,Phường Phan Chu Trinh,Phường Hàng Bài',
            'Quận Tây Hồ' => 'Phường Phú Thượng,Phường Nhật Tân,Phường Tứ Liên,Phường Quảng An,Phường Xuân La,Phường Yên Phụ,Phường Bưởi,Phường Thụy Khuê',
            'Quận Long Biên' => 'Phường Thượng Thanh,Phường Ngọc Thụy,Phường Giang Biên,Phường Đức Giang,Phường Việt Hưng,Phường Gia Thụy,Phường Ngọc Lâm,Phường Phúc Lợi,Phường Bồ Đề,Phường Sài Đồng,Phường Long Biên,Phường Thạch Bàn,Phường Phúc Đồng,Phường Cự Khối',
            'Quận Cầu Giấy' => 'Phường Nghĩa Đô,Phường Nghĩa Tân,Phường Mai Dịch,Phường Dịch Vọng,Phường Dịch Vọng Hậu,Phường Quan Hoa,Phường Yên Hoà,Phường Trung Hoà',
            'Quận Đống Đa' => 'Phường Cát Linh,Phường Văn Miếu,Phường Quốc Tử Giám,Phường Láng Thượng,Phường Ô Chợ Dừa,Phường Văn Chương,Phường Hàng Bột,Phường Láng Hạ,Phường Khâm Thiên,Phường Thổ Quan,Phường Nam Đồng,Phường Trung Phụng,Phường Quang Trung,Phường Trung Liệt,Phường Phương Liên,Phường Thịnh Quang,Phường Trung Tự,Phường Kim Liên,Phường Phương Mai,Phường Ngã Tư Sở,Phường Khương Thượng',
            'Quận Hai Bà Trưng' => 'Phường Nguyễn Du,Phường Bạch Đằng,Phường Phạm Đình Hổ,Phường Lê Đại Hành,Phường Đồng Nhân,Phường Phố Huế,Phường Đống Mác,Phường Thanh Lương,Phường Thanh Nhàn,Phường Cầu Dền,Phường Bách Khoa,Phường Đồng Tâm,Phường Vĩnh Tuy,Phường Bạch Mai,Phường Quỳnh Mai,Phường Quỳnh Lôi,Phường Minh Khai,Phường Trương Định',
            'Quận Hoàng Mai' => 'Phường Thanh Trì,Phường Vĩnh Hưng,Phường Định Công,Phường Mai Động,Phường Tương Mai,Phường Đại Kim,Phường Tân Mai,Phường Hoàng Văn Thụ,Phường Giáp Bát,Phường Lĩnh Nam,Phường Thịnh Liệt,Phường Trần Phú,Phường Hoàng Liệt,Phường Yên Sở',
            'Quận Thanh Xuân' => 'Phường Nhân Chính,Phường Thượng Đình,Phường Khương Trung,Phường Khương Mai,Phường Thanh Xuân Trung,Phường Phương Liệt,Phường Hạ Đình,Phường Khương Đình,Phường Thanh Xuân Bắc,Phường Thanh Xuân Nam,Phường Kim Giang',
            'Huyện Sóc Sơn' => 'Thị trấn Sóc Sơn,Xã Bắc Sơn,Xã Minh Trí,Xã Hồng Kỳ,Xã Nam Sơn,Xã Trung Giã,Xã Tân Hưng,Xã Minh Phú,Xã Phù Linh,Xã Bắc Phú,Xã Tân Minh,Xã Quang Tiến,Xã Hiền Ninh,Xã Tân Dân,Xã Tiên Dược,Xã Việt Long,Xã Xuân Giang,Xã Mai Đình,Xã Đức Hoà,Xã Thanh Xuân,Xã Đông Xuân,Xã Kim Lũ,Xã Phú Cường,Xã Phú Minh,Xã Phù Lỗ,Xã Xuân Thu',
            'Huyện Đông Anh' => 'Thị trấn Đông Anh,Xã Xuân Nộn,Xã Thuỵ Lâm,Xã Bắc Hồng,Xã Nguyên Khê,Xã Nam Hồng,Xã Tiên Dương,Xã Vân Hà,Xã Uy Nỗ,Xã Vân Nội,Xã Liên Hà,Xã Việt Hùng,Xã Kim Nỗ,Xã Kim Chung,Xã Dục Tú,Xã Đại Mạch,Xã Vĩnh Ngọc,Xã Cổ Loa,Xã Hải Bối,Xã Xuân Canh,Xã Võng La,Xã Tàm Xá,Xã Mai Lâm,Xã Đông Hội',
            'Huyện Gia Lâm' => 'Thị trấn Yên Viên,Xã Yên Thường,Xã Yên Viên,Xã Ninh Hiệp,Xã Đình Xuyên,Xã Dương Hà,Xã Phù Đổng,Xã Trung Mầu,Xã Lệ Chi,Xã Cổ Bi,Xã Đặng Xá,Xã Phú Thị,Xã Kim Sơn,Thị trấn Trâu Quỳ,Xã Dương Quang,Xã Dương Xá,Xã Đông Dư,Xã Đa Tốn,Xã Kiêu Kỵ,Xã Bát Tràng,Xã Kim Lan,Xã Văn Đức',
            'Quận Nam Từ Liêm' => 'Phường Cầu Diễn,Phường Xuân Phương,Phường Phương Canh,Phường Mỹ Đình 1,Phường Mỹ Đình 2,Phường Tây Mỗ,Phường Mễ Trì,Phường Phú Đô,Phường Đại Mỗ,Phường Trung Văn',
            'Huyện Thanh Trì' => 'Thị trấn Văn Điển,Xã Tân Triều,Xã Thanh Liệt,Xã Tả Thanh Oai,Xã Hữu Hoà,Xã Tam Hiệp,Xã Tứ Hiệp,Xã Yên Mỹ,Xã Vĩnh Quỳnh,Xã Ngũ Hiệp,Xã Duyên Hà,Xã Ngọc Hồi,Xã Vạn Phúc,Xã Đại áng,Xã Liên Ninh,Xã Đông Mỹ',
            'Quận Bắc Từ Liêm' => 'Phường Thượng Cát,Phường Liên Mạc,Phường Đông Ngạc,Phường Đức Thắng,Phường Thụy Phương,Phường Tây Tựu,Phường Xuân Đỉnh,Phường Xuân Tảo,Phường Minh Khai,Phường Cổ Nhuế 1,Phường Cổ Nhuế 2,Phường Phú Diễn,Phường Phúc Diễn',
            'Huyện Mê Linh' => 'Thị trấn Chi Đông,Xã Đại Thịnh,Xã Kim Hoa,Xã Thạch Đà,Xã Tiến Thắng,Xã Tự Lập,Thị trấn Quang Minh,Xã Thanh Lâm,Xã Tam Đồng,Xã Liên Mạc,Xã Vạn Yên,Xã Chu Phan,Xã Tiến Thịnh,Xã Mê Linh,Xã Văn Khê,Xã Hoàng Kim,Xã Tiền Phong,Xã Tráng Việt',
            'Quận Hà Đông' => 'Phường Nguyễn Trãi,Phường Mộ Lao,Phường Văn Quán,Phường Vạn Phúc,Phường Yết Kiêu,Phường Quang Trung,Phường La Khê,Phường Phú La,Phường Phúc La,Phường Hà Cầu,Phường Yên Nghĩa,Phường Kiến Hưng,Phường Phú Lãm,Phường Phú Lương,Phường Dương Nội,Phường Đồng Mai,Phường Biên Giang',
            'Thị xã Sơn Tây' => 'Phường Lê Lợi,Phường Phú Thịnh,Phường Ngô Quyền,Phường Quang Trung,Phường Sơn Lộc,Phường Xuân Khanh,Xã Đường Lâm,Phường Viên Sơn,Xã Xuân Sơn,Phường Trung Hưng,Xã Thanh Mỹ,Phường Trung Sơn Trầm,Xã Kim Sơn,Xã Sơn Đông,Xã Cổ Đông',
            'Huyện Ba Vì' => 'Thị trấn Tây Đằng,Xã Phú Cường,Xã Cổ Đô,Xã Tản Hồng,Xã Vạn Thắng,Xã Châu Sơn,Xã Phong Vân,Xã Phú Đông,Xã Phú Phương,Xã Phú Châu,Xã Thái Hòa,Xã Đồng Thái,Xã Phú Sơn,Xã Minh Châu,Xã Vật Lại,Xã Chu Minh,Xã Tòng Bạt,Xã Cẩm Lĩnh,Xã Sơn Đà,Xã Đông Quang,Xã Tiên Phong,Xã Thụy An,Xã Cam Thượng,Xã Thuần Mỹ,Xã Tản Lĩnh,Xã Ba Trại,Xã Minh Quang,Xã Ba Vì,Xã Vân Hòa,Xã Yên Bài,Xã Khánh Thượng',
            'Huyện Phúc Thọ' => 'Thị trấn Phúc Thọ,Xã Vân Hà,Xã Vân Phúc,Xã Vân Nam,Xã Xuân Đình,Xã Sen Phương,Xã Võng Xuyên,Xã Thọ Lộc,Xã Long Xuyên,Xã Thượng Cốc,Xã Hát Môn,Xã Tích Giang,Xã Thanh Đa,Xã Trạch Mỹ Lộc,Xã Phúc Hòa,Xã Ngọc Tảo,Xã Phụng Thượng,Xã Tam Thuấn,Xã Tam Hiệp,Xã Hiệp Thuận,Xã Liên Hiệp',
            'Huyện Đan Phượng' => 'Thị trấn Phùng,Xã Trung Châu,Xã Thọ An,Xã Thọ Xuân,Xã Hồng Hà,Xã Liên Hồng,Xã Liên Hà,Xã Hạ Mỗ,Xã Liên Trung,Xã Phương Đình,Xã Thượng Mỗ,Xã Tân Hội,Xã Tân Lập,Xã Đan Phượng,Xã Đồng Tháp,Xã Song Phượng',
            'Huyện Hoài Đức' => 'Thị trấn Trạm Trôi,Xã Đức Thượng,Xã Minh Khai,Xã Dương Liễu,Xã Di Trạch,Xã Đức Giang,Xã Cát Quế,Xã Kim Chung,Xã Yên Sở,Xã Sơn Đồng,Xã Vân Canh,Xã Đắc Sở,Xã Lại Yên,Xã Tiền Yên,Xã Song Phương,Xã An Khánh,Xã An Thượng,Xã Vân Côn,Xã La Phù,Xã Đông La',
            'Huyện Quốc Oai' => 'Xã Đông Xuân,Thị trấn Quốc Oai,Xã Sài Sơn,Xã Phượng Cách,Xã Yên Sơn,Xã Ngọc Liệp,Xã Ngọc Mỹ,Xã Liệp Tuyết,Xã Thạch Thán,Xã Đồng Quang,Xã Phú Cát,Xã Tuyết Nghĩa,Xã Nghĩa Hương,Xã Cộng Hòa,Xã Tân Phú,Xã Đại Thành,Xã Phú Mãn,Xã Cấn Hữu,Xã Tân Hòa,Xã Hòa Thạch,Xã Đông Yên',
            'Huyện Thạch Thất' => 'Xã Yên Trung,Xã Yên Bình,Xã Tiến Xuân,Thị trấn Liên Quan,Xã Đại Đồng,Xã Cẩm Yên,Xã Lại Thượng,Xã Phú Kim,Xã Hương Ngải,Xã Canh Nậu,Xã Kim Quan,Xã Dị Nậu,Xã Bình Yên,Xã Chàng Sơn,Xã Thạch Hoà,Xã Cần Kiệm,Xã Hữu Bằng,Xã Phùng Xá,Xã Tân Xã,Xã Thạch Xá,Xã Bình Phú,Xã Hạ Bằng,Xã Đồng Trúc',
            'Huyện Chương Mỹ' => 'Thị trấn Chúc Sơn,Thị trấn Xuân Mai,Xã Phụng Châu,Xã Tiên Phương,Xã Đông Sơn,Xã Đông Phương Yên,Xã Phú Nghĩa,Xã Trường Yên,Xã Ngọc Hòa,Xã Thủy Xuân Tiên,Xã Thanh Bình,Xã Trung Hòa,Xã Đại Yên,Xã Thụy Hương,Xã Tốt Động,Xã Lam Điền,Xã Tân Tiến,Xã Nam Phương Tiến,Xã Hợp Đồng,Xã Hoàng Văn Thụ,Xã Hoàng Diệu,Xã Hữu Văn,Xã Quảng Bị,Xã Mỹ Lương,Xã Thượng Vực,Xã Hồng Phong,Xã Đồng Phú,Xã Trần Phú,Xã Văn Võ,Xã Đồng Lạc,Xã Hòa Chính,Xã Phú Nam An',
            'Huyện Thanh Oai' => 'Thị trấn Kim Bài,Xã Cự Khê,Xã Bích Hòa,Xã Mỹ Hưng,Xã Cao Viên,Xã Bình Minh,Xã Tam Hưng,Xã Thanh Cao,Xã Thanh Thùy,Xã Thanh Mai,Xã Thanh Văn,Xã Đỗ Động,Xã Kim An,Xã Kim Thư,Xã Phương Trung,Xã Tân Ước,Xã Dân Hòa,Xã Liên Châu,Xã Cao Dương,Xã Xuân Dương,Xã Hồng Dương',
            'Huyện Thường Tín' => 'Thị trấn Thường Tín,Xã Ninh Sở,Xã Nhị Khê,Xã Duyên Thái,Xã Khánh Hà,Xã Hòa Bình,Xã Văn Bình,Xã Hiền Giang,Xã Hồng Vân,Xã Vân Tảo,Xã Liên Phương,Xã Văn Phú,Xã Tự Nhiên,Xã Tiền Phong,Xã Hà Hồi,Xã Thư Phú,Xã Nguyễn Trãi,Xã Quất Động,Xã Chương Dương,Xã Tân Minh,Xã Lê Lợi,Xã Thắng Lợi,Xã Dũng Tiến,Xã Thống Nhất,Xã Nghiêm Xuyên,Xã Tô Hiệu,Xã Văn Tự,Xã Vạn Điểm,Xã Minh Cường',
            'Huyện Phú Xuyên' => 'Thị trấn Phú Minh,Thị trấn Phú Xuyên,Xã Hồng Minh,Xã Phượng Dực,Xã Nam Tiến,Xã Tri Trung,Xã Đại Thắng,Xã Phú Túc,Xã Văn Hoàng,Xã Hồng Thái,Xã Hoàng Long,Xã Quang Trung,Xã Nam Phong,Xã Nam Triều,Xã Tân Dân,Xã Sơn Hà,Xã Chuyên Mỹ,Xã Khai Thái,Xã Phúc Tiến,Xã Vân Từ,Xã Tri Thủy,Xã Đại Xuyên,Xã Phú Yên,Xã Bạch Hạ,Xã Quang Lãng,Xã Châu Can,Xã Minh Tân',
            'Huyện ứng Hòa' => 'Thị trấn Vân Đình,Xã Viên An,Xã Viên Nội,Xã Hoa Sơn,Xã Quảng Phú Cầu,Xã Trường Thịnh,Xã Cao Thành,Xã Liên Bạt,Xã Sơn Công,Xã Đồng Tiến,Xã Phương Tú,Xã Trung Tú,Xã Đồng Tân,Xã Tảo Dương Văn,Xã Vạn Thái,Xã Minh Đức,Xã Hòa Lâm,Xã Hòa Xá,Xã Trầm Lộng,Xã Kim Đường,Xã Hòa Nam,Xã Hòa Phú,Xã Đội Bình,Xã Đại Hùng,Xã Đông Lỗ,Xã Phù Lưu,Xã Đại Cường,Xã Lưu Hoàng,Xã Hồng Quang',
            'Huyện Mỹ Đức' => 'Thị trấn Đại Nghĩa,Xã Đồng Tâm,Xã Thượng Lâm,Xã Tuy Lai,Xã Phúc Lâm,Xã Mỹ Thành,Xã Bột Xuyên,Xã An Mỹ,Xã Hồng Sơn,Xã Lê Thanh,Xã Xuy Xá,Xã Phùng Xá,Xã Phù Lưu Tế,Xã Đại Hưng,Xã Vạn Kim,Xã Đốc Tín,Xã Hương Sơn,Xã Hùng Tiến,Xã An Tiến,Xã Hợp Tiến,Xã Hợp Thanh,Xã An Phú',
        ],
        'Tỉnh Hà Giang' => [
            'Thành phố Hà Giang' => 'Phường Quang Trung,Phường Trần Phú,Phường Ngọc Hà,Phường Nguyễn Trãi,Phường Minh Khai,Xã Ngọc Đường,Xã Phương Độ,Xã Phương Thiện',
            'Huyện Đồng Văn' => 'Thị trấn Phó Bảng,Xã Lũng Cú,Xã Má Lé,Thị trấn Đồng Văn,Xã Lũng Táo,Xã Phố Là,Xã Thài Phìn Tủng,Xã Sủng Là,Xã Xà Phìn,Xã Tả Phìn,Xã Tả Lủng,Xã Phố Cáo,Xã Sính Lủng,Xã Sảng Tủng,Xã Lũng Thầu,Xã Hố Quáng Phìn,Xã Vần Chải,Xã Lũng Phìn,Xã Sủng Trái',
            'Huyện Mèo Vạc' => 'Thị trấn Mèo Vạc,Xã Thượng Phùng,Xã Pải Lủng,Xã Xín Cái,Xã Pả Vi,Xã Giàng Chu Phìn,Xã Sủng Trà,Xã Sủng Máng,Xã Sơn Vĩ,Xã Tả Lủng,Xã Cán Chu Phìn,Xã Lũng Pù,Xã Lũng Chinh,Xã Tát Ngà,Xã Nậm Ban,Xã Khâu Vai,Xã Niêm Tòng,Xã Niêm Sơn',
            'Huyện Yên Minh' => 'Thị trấn Yên Minh,Xã Thắng Mố,Xã Phú Lũng,Xã Sủng Tráng,Xã Bạch Đích,Xã Na Khê,Xã Sủng Thài,Xã Hữu Vinh,Xã Lao Và Chải,Xã Mậu Duệ,Xã Đông Minh,Xã Mậu Long,Xã Ngam La,Xã Ngọc Long,Xã Đường Thượng,Xã Lũng Hồ,Xã Du Tiến,Xã Du Già',
            'Huyện Quản Bạ' => 'Thị trấn Tam Sơn,Xã Bát Đại Sơn,Xã Nghĩa Thuận,Xã Cán Tỷ,Xã Cao Mã Pờ,Xã Thanh Vân,Xã Tùng Vài,Xã Đông Hà,Xã Quản Bạ,Xã Lùng Tám,Xã Quyết Tiến,Xã Tả Ván,Xã Thái An',
            'Huyện Vị Xuyên' => 'Xã Kim Thạch,Xã Phú Linh,Xã Kim Linh,Thị trấn Vị Xuyên,Thị trấn Nông Trường Việt Lâm,Xã Minh Tân,Xã Thuận Hoà,Xã Tùng Bá,Xã Thanh Thủy,Xã Thanh Đức,Xã Phong Quang,Xã Xín Chải,Xã Phương Tiến,Xã Lao Chải,Xã Cao Bồ,Xã Đạo Đức,Xã Thượng Sơn,Xã Linh Hồ,Xã Quảng Ngần,Xã Việt Lâm,Xã Ngọc Linh,Xã Ngọc Minh,Xã Bạch Ngọc,Xã Trung Thành',
            'Huyện Bắc Mê' => 'Xã Minh Sơn,Xã Minh Sơn,Xã Giáp Trung,Xã Yên Định,Thị trấn Yên Phú,Xã Minh Ngọc,Xã Yên Phong,Xã Lạc Nông,Xã Phú Nam,Xã Yên Cường,Xã Thượng Tân,Xã Đường Âm,Xã Đường Hồng,Xã Phiêng Luông',
            'Huyện Hoàng Su Phì' => 'Thị trấn Vinh Quang,Xã Bản Máy,Xã Thàng Tín,Xã Thèn Chu Phìn,Xã Pố Lồ,Xã Bản Phùng,Xã Túng Sán,Xã Chiến Phố,Xã Đản Ván,Xã Tụ Nhân,Xã Tân Tiến,Xã Nàng Đôn,Xã Pờ Ly Ngài,Xã Sán Xả Hồ,Xã Bản Luốc,Xã Ngàm Đăng Vài,Xã Bản Nhùng,Xã Tả Sử Choóng,Xã Nậm Dịch,Xã Hồ Thầu,Xã Nam Sơn,Xã Nậm Tỵ,Xã Thông Nguyên,Xã Nậm Khòa',
            'Huyện Xín Mần' => 'Thị trấn Cốc Pài,Xã Nàn Xỉn,Xã Bản Díu,Xã Chí Cà,Xã Xín Mần,Xã Thèn Phàng,Xã Trung Thịnh,Xã Pà Vầy Sủ,Xã Cốc Rế,Xã Thu Tà,Xã Nàn Ma,Xã Tả Nhìu,Xã Bản Ngò,Xã Chế Là,Xã Nấm Dẩn,Xã Quảng Nguyên,Xã Nà Chì,Xã Khuôn Lùng',
            'Huyện Bắc Quan' => 'Thị trấn Việt Quang,Thị trấn Vĩnh Tuy,Xã Tân Lập,Xã Tân Thành,Xã Đồng Tiến,Xã Đồng Tâm,Xã Tân Quang,Xã Thượng Bình,Xã Hữu Sản,Xã Kim Ngọc,Xã Việt Vinh,Xã Bằng Hành,Xã Quang Minh,Xã Liên Hiệp,Xã Vô Điếm,Xã Việt Hồng,Xã Hùng An,Xã Đức Xuân,Xã Tiên Kiều,Xã Vĩnh Hảo,Xã Vĩnh Phúc,Xã Đồng Yên,Xã Đông Thành',
            'Huyện Quang Bình' => 'Xã Xuân Minh,Xã Tiên Nguyên,Xã Tân Nam,Xã Bản Rịa,Xã Yên Thành,Thị trấn Yên Bình,Xã Tân Trịnh,Xã Tân Bắc,Xã Bằng Lang,Xã Yên Hà,Xã Hương Sơn,Xã Xuân Giang,Xã Nà Khương,Xã Tiên Yên,Xã Vĩ Thượng',
        ],
        'Tỉnh Cao Bằng' => [
            'Thành phố Cao Bằng' => 'Phường Sông Hiến,Phường Sông Bằng,Phường Hợp Giang,Phường Tân Giang,Phường Ngọc Xuân,Phường Đề Thám,Phường Hoà Chung,Phường Duyệt Trung,Xã Vĩnh Quang,Xã Hưng Đạo,Xã Chu Trinh',
            'Huyện Bảo Lâm' => 'Thị trấn Pác Miầu,Xã Đức Hạnh,Xã Lý Bôn,Xã Nam Cao,Xã Nam Quang,Xã Vĩnh Quang,Xã Quảng Lâm,Xã Thạch Lâm,Xã Vĩnh Phong,Xã Mông Ân,Xã Thái Học,Xã Thái Sơn,Xã Yên Thổ',
            'Huyện Bảo Lạc' => 'Thị trấn Bảo Lạc,Xã Cốc Pàng,Xã Thượng Hà,Xã Cô Ba,Xã Bảo Toàn,Xã Khánh Xuân,Xã Xuân Trường,Xã Hồng Trị,Xã Kim Cúc,Xã Phan Thanh,Xã Hồng An,Xã Hưng Đạo,Xã Hưng Thịnh,Xã Huy Giáp,Xã Đình Phùng,Xã Sơn Lập,Xã Sơn Lộ',
            'Huyện Hà Quảng' => 'Thị trấn Thông Nông,Xã Cần Yên,Xã Cần Nông,Xã Lương Thông,Xã Đa Thông,Xã Ngọc Động,Xã Yên Sơn,Xã Lương Can,Xã Thanh Long,Thị trấn Xuân Hòa,Xã Lũng Nặm,Xã Trường Hà,Xã Cải Viên,Xã Nội Thôn,Xã Tổng Cọt,Xã Sóc Hà,Xã Thượng Thôn,Xã Hồng Sỹ,Xã Quý Quân,Xã Mã Ba,Xã Ngọc Đào',
            'Huyện Trùng Khánh' => 'Thị trấn Trà Lĩnh,Xã Tri Phương,Xã Quang Hán,Xã Xuân Nội,Xã Quang Trung,Xã Quang Vinh,Xã Cao Chương,Thị trấn Trùng Khánh,Xã Ngọc Khê,Xã Ngọc Côn,Xã Phong Nậm,Xã Đình Phong,Xã Đàm Thuỷ,Xã Khâm Thành,Xã Chí Viễn,Xã Lăng Hiếu,Xã Phong Châu,Xã Trung Phúc,Xã Cao Thăng,Xã Đức Hồng,Xã Đoài Dương',
            'Huyện Hạ Lang' => 'Xã Minh Long,Xã Lý Quốc,Xã Thắng Lợi,Xã Đồng Loan,Xã Đức Quang,Xã Kim Loan,Xã Quang Long,Xã An Lạc,Thị trấn Thanh Nhật,Xã Vinh Quý,Xã Thống Nhất,Xã Cô Ngân,Xã Thị Hoa',
            'Huyện Quảng Hòa' => 'Xã Quốc Toản,Thị trấn Quảng Uyên,Xã Phi Hải,Xã Quảng Hưng,Xã Độc Lập,Xã Cai Bộ,Xã Phúc Sen,Xã Chí Thảo,Xã Tự Do,Xã Hồng Quang,Xã Ngọc Động,Xã Hạnh Phúc,Thị trấn Tà Lùng,Xã Bế Văn Đàn,Xã Cách Linh,Xã Đại Sơn,Xã Tiên Thành,Thị trấn Hoà Thuận,Xã Mỹ Hưng',
            'Huyện Hòa An' => 'Thị trấn Nước Hai,Xã Dân Chủ,Xã Nam Tuấn,Xã Đại Tiến,Xã Đức Long,Xã Ngũ Lão,Xã Trương Lương,Xã Hồng Việt,Xã Hoàng Tung,Xã Nguyễn Huệ,Xã Quang Trung,Xã Bạch Đằng,Xã Bình Dương,Xã Lê Chung,Xã Hồng Nam',
            'Huyện Nguyên Bình' => 'Thị trấn Nguyên Bình,Thị trấn Tĩnh Túc,Xã Yên Lạc,Xã Triệu Nguyên,Xã Ca Thành,Xã Vũ Nông,Xã Minh Tâm,Xã Thể Dục,Xã Mai Long,Xã Vũ Minh,Xã Hoa Thám,Xã Phan Thanh,Xã Quang Thành,Xã Tam Kim,Xã Thành Công,Xã Thịnh Vượng,Xã Hưng Đạo',
            'Huyện Thạch An' => 'Thị trấn Đông Khê,Xã Canh Tân,Xã Kim Đồng,Xã Minh Khai,Xã Đức Thông,Xã Thái Cường,Xã Vân Trình,Xã Thụy Hùng,Xã Quang Trọng,Xã Trọng Con,Xã Lê Lai,Xã Đức Long,Xã Lê Lợi,Xã Đức Xuân',
        ],
        'Tỉnh Bắc Kạn' => [
            'Thành phố Bắc Kạn' => 'Phường Nguyễn Thị Minh Khai,Phường Sông Cầu,Phường Đức Xuân,Phường Phùng Chí Kiên,Phường Huyền Tụng,Xã Dương Quang,Xã Nông Thượng,Phường Xuất Hóa',
            'Huyện Pác Nặm' => 'Xã Bằng Thành,Xã Nhạn Môn,Xã Bộc Bố,Xã Công Bằng,Xã Giáo Hiệu,Xã Xuân La,Xã An Thắng,Xã Cổ Linh,Xã Nghiên Loan,Xã Cao Tân',
            'Huyện Ba Bể' => 'Thị trấn Chợ Rã,Xã Bành Trạch,Xã Phúc Lộc,Xã Hà Hiệu,Xã Cao Thượng,Xã Khang Ninh,Xã Nam Mẫu,Xã Thượng Giáo,Xã Địa Linh,Xã Yến Dương,Xã Chu Hương,Xã Quảng Khê,Xã Mỹ Phương,Xã Hoàng Trĩ,Xã Đồng Phúc',
            'Huyện Ngân Sơn' => 'Thị trấn Nà Phặc,Xã Thượng Ân,Xã Bằng Vân,Xã Cốc Đán,Xã Trung Hoà,Xã Đức Vân,Xã Vân Tùng,Xã Thượng Quan,Xã Hiệp Lực,Xã Thuần Mang',
            'Huyện Bạch Thông' => 'Thị trấn Phủ Thông,Xã Vi Hương,Xã Sĩ Bình,Xã Vũ Muộn,Xã Đôn Phong,Xã Lục Bình,Xã Tân Tú,Xã Nguyên Phúc,Xã Cao Sơn,Xã Quân Hà,Xã Cẩm Giàng,Xã Mỹ Thanh,Xã Dương Phong,Xã Quang Thuận',
            'Huyện Chợ Đồn' => 'Thị trấn Bằng Lũng,Xã Xuân Lạc,Xã Nam Cường,Xã Đồng Lạc,Xã Tân Lập,Xã Bản Thi,Xã Quảng Bạch,Xã Bằng Phúc,Xã Yên Thịnh,Xã Yên Thượng,Xã Phương Viên,Xã Ngọc Phái,Xã Đồng Thắng,Xã Lương Bằng,Xã Bằng Lãng,Xã Đại Sảo,Xã Nghĩa Tá,Xã Yên Mỹ,Xã Bình Trung,Xã Yên Phong',
            'Huyện Chợ Mới' => 'Thị trấn Đồng Tâm,Xã Tân Sơn,Xã Thanh Vận,Xã Mai Lạp,Xã Hoà Mục,Xã Thanh Mai,Xã Cao Kỳ,Xã Nông Hạ,Xã Yên Cư,Xã Thanh Thịnh,Xã Yên Hân,Xã Như Cố,Xã Bình Văn,Xã Quảng Chu',
            'Huyện Na Rì' => 'Xã Văn Vũ,Xã Văn Lang,Xã Lương Thượng,Xã Kim Hỷ,Xã Cường Lợi,Thị trấn Yến Lạc,Xã Kim Lư,Xã Sơn Thành,Xã Văn Minh,Xã Côn Minh,Xã Cư Lễ,Xã Trần Phú,Xã Quang Phong,Xã Dương Sơn,Xã Xuân Dương,Xã Đổng Xá,Xã Liêm Thuỷ',
        ],
        'Tỉnh Tuyên Quang' => [
            'Thành phố Tuyên Quang' => 'Phường Phan Thiết,Phường Minh Xuân,Phường Tân Quang,Xã Tràng Đà,Phường Nông Tiến,Phường Ỷ La,Phường Tân Hà,Phường Hưng Thành,Xã Kim Phú,Xã An Khang,Phường Mỹ Lâm,Phường An Tường,Xã Lưỡng Vượng,Xã Thái Long,Phường Đội Cấn',
            'Huyện Lâm Bình' => 'Xã Phúc Yên,Xã Xuân Lập,Xã Khuôn Hà,Thị trấn Lăng Can,Xã Thượng Lâm,Xã Bình An,Xã Hồng Quang,Xã Thổ Bình,Xã Phúc Sơn,Xã Minh Quang',
            'Huyện Na Hang' => 'Thị trấn Na Hang,Xã Sinh Long,Xã Thượng Giáp,Xã Thượng Nông,Xã Côn Lôn,Xã Yên Hoa,Xã Hồng Thái,Xã Đà Vị,Xã Khau Tinh,Xã Sơn Phú,Xã Năng Khả,Xã Thanh Tương',
            'Huyện Chiêm Hóa' => 'Thị trấn Vĩnh Lộc,Xã Trung Hà,Xã Tân Mỹ,Xã Hà Lang,Xã Hùng Mỹ,Xã Yên Lập,Xã Tân An,Xã Bình Phú,Xã Xuân Quang,Xã Ngọc Hội,Xã Phú Bình,Xã Hòa Phú,Xã Phúc Thịnh,Xã Kiên Đài,Xã Tân Thịnh,Xã Trung Hòa,Xã Kim Bình,Xã Hòa An,Xã Vinh Quang,Xã Tri Phú,Xã Nhân Lý,Xã Yên Nguyên,Xã Linh Phú,Xã Bình Nhân',
            'Huyện Hàm Yên' => 'Thị trấn Tân Yên,Xã Yên Thuận,Xã Bạch Xa,Xã Minh Khương,Xã Yên Lâm,Xã Minh Dân,Xã Phù Lưu,Xã Minh Hương,Xã Yên Phú,Xã Tân Thành,Xã Bình Xa,Xã Thái Sơn,Xã Nhân Mục,Xã Thành Long,Xã Bằng Cốc,Xã Thái Hòa,Xã Đức Ninh,Xã Hùng Đức',
            'Huyện Yên Sơn' => 'Xã Quí Quân,Xã Lực Hành,Xã Kiến Thiết,Xã Trung Minh,Xã Chiêu Yên,Xã Trung Trực,Xã Xuân Vân,Xã Phúc Ninh,Xã Hùng Lợi,Xã Trung Sơn,Xã Tân Tiến,Xã Tứ Quận,Xã Đạo Viện,Xã Tân Long,Thị trấn Yên Sơn,Xã Kim Quan,Xã Lang Quán,Xã Phú Thịnh,Xã Công Đa,Xã Trung Môn,Xã Chân Sơn,Xã Thái Bình,Xã Tiến Bộ,Xã Mỹ Bằng,Xã Hoàng Khai,Xã Nhữ Hán,Xã Nhữ Khê,Xã Đội Bình',
            'Huyện Sơn Dương' => 'Thị trấn Sơn Dương,Xã Trung Yên,Xã Minh Thanh,Xã Tân Trào,Xã Vĩnh Lợi,Xã Thượng Ấm,Xã Bình Yên,Xã Lương Thiện,Xã Tú Thịnh,Xã Cấp Tiến,Xã Hợp Thành,Xã Phúc Ứng,Xã Đông Thọ,Xã Kháng Nhật,Xã Hợp Hòa,Xã Quyết Thắng,Xã Đồng Quý,Xã Tân Thanh,Xã Vân Sơn,Xã Văn Phú,Xã Chi Thiết,Xã Đông Lợi,Xã Thiện Kế,Xã Hồng Lạc,Xã Phú Lương,Xã Ninh Lai,Xã Đại Phú,Xã Sơn Nam,Xã Hào Phú,Xã Tam Đa,Xã Trường Sinh',
        ],
        'Tỉnh Lào Cai' => [
            'Thành phố Lào Cai' => 'Phường Duyên Hải,Phường Lào Cai,Phường Cốc Lếu,Phường Kim Tân,Phường Bắc Lệnh,Phường Pom Hán,Phường Xuân Tăng,Phường Bình Minh,Xã Thống Nhất,Xã Đồng Tuyển,Xã Vạn Hoà,Phường Bắc Cường,Phường Nam Cường,Xã Cam Đường,Xã Tả Phời,Xã Hợp Thành,Xã Cốc San',
            'Huyện Bát Xát' => 'Thị trấn Bát Xát,Xã A Mú Sung,Xã Nậm Chạc,Xã A Lù,Xã Trịnh Tường,Xã Y Tý,Xã Cốc Mỳ,Xã Dền Sáng,Xã Bản Vược,Xã Sàng Ma Sáo,Xã Bản Qua,Xã Mường Vi,Xã Dền Thàng,Xã Bản Xèo,Xã Mường Hum,Xã Trung Lèng Hồ,Xã Quang Kim,Xã Pa Cheo,Xã Nậm Pung,Xã Phìn Ngan,Xã Tòng Sành',
            'Huyện Mường Khương' => 'Xã Pha Long,Xã Tả Ngải Chồ,Xã Tung Chung Phố,Thị trấn Mường Khương,Xã Dìn Chin,Xã Tả Gia Khâu,Xã Nậm Chảy,Xã Nấm Lư,Xã Lùng Khấu Nhin,Xã Thanh Bình,Xã Cao Sơn,Xã Lùng Vai,Xã Bản Lầu,Xã La Pan Tẩn,Xã Tả Thàng,Xã Bản Sen',
            'Huyện Si Ma Cai' => 'Xã Nàn Sán,Xã Thào Chư Phìn,Xã Bản Mế,Thị trấn Si Ma Cai,Xã Sán Chải,Xã Lùng Thẩn,Xã Cán Cấu,Xã Sín Chéng,Xã Quan Hồ Thẩn,Xã Nàn Xín',
            'Huyện Bắc Hà' => 'Thị trấn Bắc Hà,Xã Lùng Cải,Xã Lùng Phình,Xã Tả Van Chư,Xã Tả Củ Tỷ,Xã Thải Giàng Phố,Xã Hoàng Thu Phố,Xã Bản Phố,Xã Bản Liền,Xã Tà Chải,Xã Na Hối,Xã Cốc Ly,Xã Nậm Mòn,Xã Nậm Đét,Xã Nậm Khánh,Xã Bảo Nhai,Xã Nậm Lúc,Xã Cốc Lầu,Xã Bản Cái',
            'Huyện Bảo Thắng' => 'Thị trấn N.T Phong Hải,Thị trấn Phố Lu,Thị trấn Tằng Loỏng,Xã Bản Phiệt,Xã Bản Cầm,Xã Thái Niên,Xã Phong Niên,Xã Gia Phú,Xã Xuân Quang,Xã Sơn Hải,Xã Xuân Giao,Xã Trì Quang,Xã Sơn Hà,Xã Phú Nhuận',
            'Huyện Bảo Yên' => 'Thị trấn Phố Ràng,Xã Tân Tiến,Xã Nghĩa Đô,Xã Vĩnh Yên,Xã Điện Quan,Xã Xuân Hoà,Xã Tân Dương,Xã Thượng Hà,Xã Kim Sơn,Xã Cam Cọn,Xã Minh Tân,Xã Xuân Thượng,Xã Việt Tiến,Xã Yên Sơn,Xã Bảo Hà,Xã Lương Sơn,Xã Phúc Khánh',
            'Thị xã SaPa' => 'Phường Sa Pa,Phường Sa Pả,Phường Ô Quý Hồ,Xã Ngũ Chỉ Sơn,Phường Phan Si Păng,Xã Trung Chải,Xã Tả Phìn,Phường Hàm Rồng,Xã Hoàng Liên,Xã Thanh Bình,Phường Cầu Mây,Xã Mường Hoa,Xã Tả Van,Xã Mường Bo,Xã Bản Hồ,Xã Liên Minh',
            'Huyện Văn Bàn' => 'Thị trấn Khánh Yên,Xã Võ Lao,Xã Sơn Thuỷ,Xã Nậm Mả,Xã Tân Thượng,Xã Nậm Rạng,Xã Nậm Chầy,Xã Tân An,Xã Khánh Yên Thượng,Xã Nậm Xé,Xã Dần Thàng,Xã Chiềng Ken,Xã Làng Giàng,Xã Hoà Mạc,Xã Khánh Yên Trung,Xã Khánh Yên Hạ,Xã Dương Quỳ,Xã Nậm Tha,Xã Minh Lương,Xã Thẩm Dương,Xã Liêm Phú,Xã Nậm Xây',
        ],
        'Tỉnh Điện Biên' => [
            'Thành phố Điện Biên Phủ' => 'Phường Noong Bua,Phường Him Lam,Phường Thanh Bình,Phường Tân Thanh,Phường Mường Thanh,Phường Nam Thanh,Phường Thanh Trường,Xã Thanh Minh,Xã Nà Tấu,Xã Nà Nhạn,Xã Mường Phăng,Xã Pá Khoang',
            'Thị xã Mường Lay' => 'Phường Sông Đà,Phường Na Lay,Xã Lay Nưa',
            'Huyện Mường Nhé' => 'Xã Sín Thầu,Xã Sen Thượng,Xã Chung Chải,Xã Leng Su Sìn,Xã Pá Mỳ,Xã Mường Nhé,Xã Nậm Vì,Xã Nậm Kè,Xã Mường Toong,Xã Quảng Lâm,Xã Huổi Lếnh',
            'Huyện Mường Chà' => 'Thị Trấn Mường Chà,Xã Xá Tổng,Xã Mường Tùng,Xã Hừa Ngài,Xã Huổi Mí,Xã Pa Ham,Xã Nậm Nèn,Xã Huổi Lèng,Xã Sa Lông,Xã Ma Thì Hồ,Xã Na Sang,Xã Mường Mươn',
            'Huyện Tủa Chùa' => 'Thị trấn Tủa Chùa,Xã Huổi Só,Xã Xín Chải,Xã Tả Sìn Thàng,Xã Lao Xả Phình,Xã Tả Phìn,Xã Tủa Thàng,Xã Trung Thu,Xã Sính Phình,Xã Sáng Nhè,Xã Mường Đun,Xã Mường Báng',
            'Huyện Tuần Giáo' => 'Thị trấn Tuần Giáo,Xã Phình Sáng,Xã Rạng Đông,Xã Mùn Chung,Xã Nà Tòng,Xã Ta Ma,Xã Mường Mùn,Xã Pú Xi,Xã Pú Nhung,Xã Quài Nưa,Xã Mường Thín,Xã Tỏa Tình,Xã Nà Sáy,Xã Mường Khong,Xã Quài Cang,Xã Quài Tở,Xã Chiềng Sinh,Xã Chiềng Đông,Xã Tênh Phông',
            'Huyện Điện Biên' => 'Xã Mường Pồn,Xã Thanh Nưa,Xã Hua Thanh,Xã Thanh Luông,Xã Thanh Hưng,Xã Thanh Xương,Xã Thanh Chăn,Xã Pa Thơm,Xã Thanh An,Xã Thanh Yên,Xã Noong Luống,Xã Noọng Hẹt,Xã Sam Mứn,Xã Pom Lót,Xã Núa Ngam,Xã Hẹ Muông,Xã Na Ư,Xã Mường Nhà,Xã Na Tông,Xã Mường Lói,Xã Phu Luông',
            'Huyện Điện Biên Đông' => 'Thị trấn Điện Biên Đông,Xã Na Son,Xã Phì Nhừ,Xã Chiềng Sơ,Xã Mường Luân,Xã Pú Nhi,Xã Nong U,Xã Xa Dung,Xã Keo Lôm,Xã Luân Giới,Xã Phình Giàng,Xã Pú Hồng,Xã Tìa Dình,Xã Háng Lìa',
            'Huyện Mường Ảng' => 'Thị trấn Mường Ảng,Xã Mường Đăng,Xã Ngối Cáy,Xã Ẳng Tở,Xã Búng Lao,Xã Xuân Lao,Xã Ẳng Nưa,Xã Ẳng Cang,Xã Nặm Lịch,Xã Mường Lạn',
            'Huyện Nậm Pồ' => 'Xã Nậm Tin,Xã Pa Tần,Xã Chà Cang,Xã Na Cô Sa,Xã Nà Khoa,Xã Nà Hỳ,Xã Nà Bủng,Xã Nậm Nhừ,Xã Nậm Chua,Xã Nậm Khăn,Xã Chà Tở,Xã Vàng Đán,Xã Chà Nưa,Xã Phìn Hồ,Xã Si Pa Phìn',
        ],
        'Tỉnh Lai Châu' => [
            'Thành phố Lai Châu' => 'Phường Quyết Thắng,Phường Tân Phong,Phường Quyết Tiến,Phường Đoàn Kết,Xã Sùng Phài,Phường Đông Phong,Xã San Thàng',
            'Huyện Tam Đường' => 'Thị trấn Tam Đường,Xã Thèn Sin,Xã Tả Lèng,Xã Giang Ma,Xã Hồ Thầu,Xã Bình Lư,Xã Sơn Bình,Xã Nùng Nàng,Xã Bản Giang,Xã Bản Hon,Xã Bản Bo,Xã Nà Tăm,Xã Khun Há',
            'Huyện Mường Tè' => 'Thị trấn Mường Tè,Xã Thu Lũm,Xã Ka Lăng,Xã Tá Bạ,Xã Pa ủ,Xã Mường Tè,Xã Pa Vệ Sử,Xã Mù Cả,Xã Bum Tở,Xã Nậm Khao,Xã Tà Tổng,Xã Bum Nưa,Xã Vàng San,Xã Kan Hồ',
            'Huyện Sìn Hồ' => 'Thị trấn Sìn Hồ,Xã Chăn Nưa,Xã Pa Tần,Xã Phìn Hồ,Xã Hồng Thu,Xã Phăng Sô Lin,Xã Ma Quai,Xã Lùng Thàng,Xã Tả Phìn,Xã Sà Dề Phìn,Xã Nậm Tăm,Xã Tả Ngảo,Xã Pu Sam Cáp,Xã Nậm Cha,Xã Pa Khoá,Xã Làng Mô,Xã Noong Hẻo,Xã Nậm Mạ,Xã Căn Co,Xã Tủa Sín Chải,Xã Nậm Cuổi,Xã Nậm Hăn',
            'Huyện Phong Thổ' => 'Xã Lả Nhì Thàng,Xã Huổi Luông,Thị trấn Phong Thổ,Xã Sì Lở Lầu,Xã Mồ Sì San,Xã Pa Vây Sử,Xã Vàng Ma Chải,Xã Tông Qua Lìn,Xã Mù Sang,Xã Dào San,Xã Ma Ly Pho,Xã Bản Lang,Xã Hoang Thèn,Xã Khổng Lào,Xã Nậm Xe,Xã Mường So,Xã Sin Suối Hồ',
            'Huyện Than Uyên' => 'Thị trấn Than Uyên,Xã Phúc Than,Xã Mường Than,Xã Mường Mít,Xã Pha Mu,Xã Mường Cang,Xã Hua Nà,Xã Tà Hừa,Xã Mường Kim,Xã Tà Mung,Xã Tà Gia,Xã Khoen On',
            'Huyện Tân Uyên' => 'Thị trấn Tân Uyên,Xã Mường Khoa,Xã Phúc Khoa,Xã Thân Thuộc,Xã Trung Đồng,Xã Hố Mít,Xã Nậm Cần,Xã Nậm Sỏ,Xã Pắc Ta,Xã Tà Mít',
            'Huyện Nậm Nhìn' => 'Thị trấn Nậm Nhùn,Xã Hua Bun,Xã Mường Mô,Xã Nậm Chà,Xã Nậm Manh,Xã Nậm Hàng,Xã Lê Lợi,Xã Pú Đao,Xã Nậm Pì,Xã Nậm Ban,Xã Trung Chải',
        ],
        'Tỉnh Sơn La' => [
            'Thành phố Sơn La' => 'Phường Chiềng Lề,Phường Tô Hiệu,Phường Quyết Thắng,Phường Quyết Tâm,Xã Chiềng Cọ,Xã Chiềng Đen,Xã Chiềng Xôm,Phường Chiềng An,Phường Chiềng Cơi,Xã Chiềng Ngần,Xã Hua La,Phường Chiềng Sinh',
            'Huyện Quỳnh Nhai' => 'Xã Mường Chiên,Xã Cà Nàng,Xã Chiềng Khay,Xã Mường Giôn,Xã Pá Ma Pha Khinh,Xã Chiềng Ơn,Xã Mường Giàng,Xã Chiềng Bằng,Xã Mường Sại,Xã Nậm ét,Xã Chiềng Khoang',
            'Huyện Thuận Châu' => 'Thị trấn Thuận Châu,Xã Mường é,Xã Chiềng Pha,Xã Chiềng La,Xã Chiềng Ngàm,Xã Liệp Tè,Xã é Tòng,Xã Phổng Lập,Xã Phổng Lăng,Xã Chiềng Ly,Xã Noong Lay,Xã Mường Khiêng,Xã Mường Bám,Xã Long Hẹ,Xã Phổng Lái,Xã Chiềng Bôm,Xã Thôm Mòn,Xã Tông Lạnh,Xã Tông Cọ,Xã Bó Mười,Xã Co Mạ,Xã Púng Tra,Xã Chiềng Pấc,Xã Nậm Lầu,Xã Bon Phặng,Xã Co Tòng,Xã Muổi Nọi,Xã Pá Lông,Xã Bản Lầm',
            'Huyện Mường La' => 'Thị trấn Ít Ong,Xã Nậm Giôn,Xã Chiềng Lao,Xã Hua Trai,Xã Ngọc Chiến,Xã Mường Trai,Xã Nậm Păm,Xã Chiềng Muôn,Xã Chiềng Ân,Xã Pi Toong,Xã Chiềng Công,Xã Tạ Bú,Xã Chiềng San,Xã Mường Bú,Xã Chiềng Hoa,Xã Mường Chùm',
            'Huyện Bắc Yên' => 'Thị trấn Bắc Yên,Xã Phiêng Ban,Xã Hang Chú,Xã Xím Vàng,Xã Tà Xùa,Xã Háng Đồng,Xã Pắc Ngà,Xã Làng Chếu,Xã Chim Vàn,Xã Mường Khoa,Xã Song Pe,Xã Hồng Ngài,Xã Tạ Khoa,Xã Hua Nhàn,Xã Phiêng Côn,Xã Chiềng Sại',
            'Huyện Phù Yên' => 'Thị trấn Phù Yên,Xã Suối Tọ,Xã Mường Thải,Xã Mường Cơi,Xã Quang Huy,Xã Huy Bắc,Xã Huy Thượng,Xã Tân Lang,Xã Gia Phù,Xã Tường Phù,Xã Huy Hạ,Xã Huy Tân,Xã Mường Lang,Xã Suối Bau,Xã Huy Tường,Xã Mường Do,Xã Sập Xa,Xã Tường Thượng,Xã Tường Tiến,Xã Tường Phong,Xã Tường Hạ,Xã Kim Bon,Xã Mường Bang,Xã Đá Đỏ,Xã Tân Phong,Xã Nam Phong,Xã Bắc Phong',
            'Huyện Mộc Châu' => 'Thị trấn Mộc Châu,Thị trấn NT Mộc Châu,Xã Chiềng Sơn,Xã Tân Hợp,Xã Qui Hướng,Xã Tân Lập,Xã Nà Mường,Xã Tà Lai,Xã Chiềng Hắc,Xã Hua Păng,Xã Chiềng Khừa,Xã Mường Sang,Xã Đông Sang,Xã Phiêng Luông,Xã Lóng Sập',
            'Huyện Yên Châu' => 'Thị trấn Yên Châu,Xã Chiềng Đông,Xã Sập Vạt,Xã Chiềng Sàng,Xã Chiềng Pằn,Xã Viêng Lán,Xã Chiềng Hặc,Xã Mường Lựm,Xã Chiềng On,Xã Yên Sơn,Xã Chiềng Khoi,Xã Tú Nang,Xã Lóng Phiêng,Xã Phiêng Khoài,Xã Chiềng Tương',
            'Huyện Mai Sơn' => 'Thị trấn Hát Lót,Xã Chiềng Sung,Xã Mường Bằng,Xã Chiềng Chăn,Xã Mương Chanh,Xã Chiềng Ban,Xã Chiềng Mung,Xã Mường Bon,Xã Chiềng Chung,Xã Chiềng Mai,Xã Hát Lót,Xã Nà Pó,Xã Cò  Nòi,Xã Chiềng Nơi,Xã Phiêng Cằm,Xã Chiềng Dong,Xã Chiềng Kheo,Xã Chiềng Ve,Xã Chiềng Lương,Xã Phiêng Pằn,Xã Nà Ơt,Xã Tà Hộc',
            'Huyện Sông Mã' => 'Thị trấn Sông Mã,Xã Bó Sinh,Xã Pú Pẩu,Xã Chiềng Phung,Xã Chiềng En,Xã Mường Lầm,Xã Nậm Ty,Xã Đứa Mòn,Xã Yên Hưng,Xã Chiềng Sơ,Xã Nà Nghịu,Xã Nậm Mằn,Xã Chiềng Khoong,Xã Chiềng Cang,Xã Huổi Một,Xã Mường Sai,Xã Mường Cai,Xã Mường Hung,Xã Chiềng Khương',
            'Huyện Sốp Cộp' => 'Xã Sam Kha,Xã Púng Bánh,Xã Sốp Cộp,Xã Dồm Cang,Xã Nậm Lạnh,Xã Mường Lèo,Xã Mường Và,Xã Mường Lạn',
            'Huyện Vân Hồ' => 'Xã Suối Bàng,Xã Song Khủa,Xã Liên Hoà,Xã Tô Múa,Xã Mường Tè,Xã Chiềng Khoa,Xã Mường Men,Xã Quang Minh,Xã Vân Hồ,Xã Lóng Luông,Xã Chiềng Yên,Xã Chiềng Xuân,Xã Xuân Nha,Xã Tân Xuân',
        ],
        'Tỉnh Yên Bái' => [
            'Thành phố Yên Bái' => 'Phường Yên Thịnh,Phường Yên Ninh,Phường Minh Tân,Phường Nguyễn Thái Học,Phường Đồng Tâm,Phường Nguyễn Phúc,Phường Hồng Hà,Xã Minh Bảo,Phường Nam Cường,Xã Tuy Lộc,Xã Tân Thịnh,Xã Âu Lâu,Xã Giới Phiên,Phường Hợp Minh,Xã Văn Phú',
            'Thị xã Nghĩa Lộ' => 'Phường Pú Trạng,Phường Trung Tâm,Phường Tân An,Phường Cầu Thia,Xã Nghĩa Lợi,Xã Nghĩa Phúc,Xã Nghĩa An,Xã Nghĩa Lộ,Xã Sơn A,Xã Phù Nham,Xã Thanh Lương,Xã Hạnh Sơn,Xã Phúc Sơn,Xã Thạch Lương',
            'Huyện Lục Yên' => 'Thị trấn Yên Thế,Xã Tân Phượng,Xã Lâm Thượng,Xã Khánh Thiện,Xã Minh Chuẩn,Xã Mai Sơn,Xã Khai Trung,Xã Mường Lai,Xã An Lạc,Xã Minh Xuân,Xã Tô Mậu,Xã Tân Lĩnh,Xã Yên Thắng,Xã Khánh Hoà,Xã Vĩnh Lạc,Xã Liễu Đô,Xã Động Quan,Xã Tân Lập,Xã Minh Tiến,Xã Trúc Lâu,Xã Phúc Lợi,Xã Phan Thanh,Xã An Phú,Xã Trung Tâm',
            'Huyện Văn Yên' => 'Thị trấn Mậu A,Xã Lang Thíp,Xã Lâm Giang,Xã Châu Quế Thượng,Xã Châu Quế Hạ,Xã An Bình,Xã Quang Minh,Xã Đông An,Xã Đông Cuông,Xã Phong Dụ Hạ,Xã Mậu Đông,Xã Ngòi A,Xã Xuân Tầm,Xã Tân Hợp,Xã An Thịnh,Xã Yên Thái,Xã Phong Dụ Thượng,Xã Yên Hợp,Xã Đại Sơn,Xã Đại Phác,Xã Yên Phú,Xã Xuân Ái,Xã Viễn Sơn,Xã Mỏ Vàng,Xã Nà Hẩu',
            'Huyện Mù Căng Chải' => 'Thị trấn Mù Căng Chải,Xã Hồ Bốn,Xã Nậm Có,Xã Khao Mang,Xã Mồ Dề,Xã Chế Cu Nha,Xã Lao Chải,Xã Kim Nọi,Xã Cao Phạ,Xã La Pán Tẩn,Xã Dế Su Phình,Xã Chế Tạo,Xã Púng Luông,Xã Nậm Khắt',
            'Huyện Trấn Yên' => 'Thị trấn Cổ Phúc,Xã Tân Đồng,Xã Báo Đáp,Xã Đào Thịnh,Xã Việt Thành,Xã Hòa Cuông,Xã Minh Quán,Xã Quy Mông,Xã Cường Thịnh,Xã Kiên Thành,Xã Nga Quán,Xã Y Can,Xã Lương Thịnh,Xã Bảo Hưng,Xã Việt Cường,Xã Minh Quân,Xã Hồng Ca,Xã Hưng Thịnh,Xã Hưng Khánh,Xã Việt Hồng,Xã Vân Hội',
            'Huyện Trạm Tấu' => 'Thị trấn Trạm Tấu,Xã Túc Đán,Xã Pá Lau,Xã Xà Hồ,Xã Phình Hồ,Xã Trạm Tấu,Xã Tà Si Láng,Xã Pá Hu,Xã Làng Nhì,Xã Bản Công,Xã Bản Mù,Xã Hát Lìu',
            'Huyện Văn Chấn' => 'Thị trấn NT Liên Sơn,Thị trấn NT Trần Phú,Xã Tú Lệ,Xã Nậm Búng,Xã Gia Hội,Xã Sùng Đô,Xã Nậm Mười,Xã An Lương,Xã Nậm Lành,Xã Sơn Lương,Xã Suối Quyền,Xã Suối Giàng,Xã Nghĩa Sơn,Xã Suối Bu,Thị trấn Sơn Thịnh,Xã Đại Lịch,Xã Đồng Khê,Xã Cát Thịnh,Xã Tân Thịnh,Xã Chấn Thịnh,Xã Bình Thuận,Xã Thượng Bằng La,Xã Minh An,Xã Nghĩa Tâm',
            'Huyện Yên Bình' => 'Thị trấn Yên Bình,Thị trấn Thác Bà,Xã Xuân Long,Xã Cảm Nhân,Xã Ngọc Chấn,Xã Tân Nguyên,Xã Phúc Ninh,Xã Bảo Ái,Xã Mỹ Gia,Xã Xuân Lai,Xã Mông Sơn,Xã Cảm Ân,Xã Yên Thành,Xã Tân Hương,Xã Phúc An,Xã Bạch Hà,Xã Vũ Linh,Xã Đại Đồng,Xã Vĩnh Kiên,Xã Yên Bình,Xã Thịnh Hưng,Xã Hán Đà,Xã Phú Thịnh,Xã Đại Minh',
        ],
        'Tỉnh Hòa Bình' => [
            'Thành phố Hòa Bình' => 'Phường Thái Bình,Phường Tân Hòa,Phường Thịnh Lang,Phường Hữu Nghị,Phường Tân Thịnh,Phường Đồng Tiến,Phường Phương Lâm,Xã Yên Mông,Phường Quỳnh Lâm,Phường Dân Chủ,Xã Hòa Bình,Phường Thống Nhất,Phường Kỳ Sơn,Xã Thịnh Minh,Xã Hợp Thành,Xã Quang Tiến,Xã Mông Hóa,Phường Trung Minh,Xã Độc Lập',
            'Huyện Đà Bắc' => 'Thị trấn Đà Bắc,Xã Nánh Nghê,Xã Giáp Đắt,Xã Mường Chiềng,Xã Tân Pheo,Xã Đồng Chum,Xã Tân Minh,Xã Đoàn Kết,Xã Đồng Ruộng,Xã Tú Lý,Xã Trung Thành,Xã Yên Hòa,Xã Cao Sơn,Xã Toàn Sơn,Xã Hiền Lương,Xã Tiền Phong,Xã Vầy Nưa',
            'Huyện Lương Sơn' => 'Thị trấn Lương Sơn,Xã Lâm Sơn,Xã Hòa Sơn,Xã Tân Vinh,Xã Nhuận Trạch,Xã Cao Sơn,Xã Cư Yên,Xã Liên Sơn,Xã Cao Dương,Xã Thanh Sơn,Xã Thanh Cao',
            'Huyện Kim Bôi' => 'Thị trấn Bo,Xã Đú Sáng,Xã Hùng Sơn,Xã Bình Sơn,Xã Tú Sơn,Xã Vĩnh Tiến,Xã Đông Bắc,Xã Xuân Thủy,Xã Vĩnh Đồng,Xã Kim Lập,Xã Hợp Tiến,Xã Kim Bôi,Xã Nam Thượng,Xã Cuối Hạ,Xã Sào Báy,Xã Mi Hòa,Xã Nuông Dăm',
            'Huyện Cao Phong' => 'Thị trấn Cao Phong,Xã Bình Thanh,Xã Thung Nai,Xã Bắc Phong,Xã Thu Phong,Xã Hợp Phong,Xã Tây Phong,Xã Dũng Phong,Xã Nam Phong,Xã Thạch Yên',
            'Huyện Tân Lạc' => 'Thị trấn Mãn Đức,Xã Suối Hoa,Xã Phú Vinh,Xã Phú Cường,Xã Mỹ Hòa,Xã Quyết Chiến,Xã Phong Phú,Xã Tử Nê,Xã Thanh Hối,Xã Ngọc Mỹ,Xã Đông Lai,Xã Vân Sơn,Xã Nhân Mỹ,Xã Lỗ Sơn,Xã Ngổ Luông,Xã Gia Mô',
            'Huyện Mai Châu' => 'Xã Tân Thành,Thị trấn Mai Châu,Xã Sơn Thủy,Xã Pà Cò,Xã Hang Kia,Xã Đồng Tân,Xã Cun Pheo,Xã Bao La,Xã Tòng Đậu,Xã Nà Phòn,Xã Săm Khóe,Xã Chiềng Châu,Xã Mai Hạ,Xã Thành Sơn,Xã Mai Hịch,Xã Vạn Mai',
            'Huyện Lạc Sơn' => 'Thị trấn Vụ Bản,Xã Quý Hòa,Xã Miền Đồi,Xã Mỹ Thành,Xã Tuân Đạo,Xã Văn Nghĩa,Xã Văn Sơn,Xã Tân Lập,Xã Nhân Nghĩa,Xã Thượng Cốc,Xã Quyết Thắng,Xã Xuất Hóa,Xã Yên Phú,Xã Bình Hẻm,Xã Định Cư,Xã Chí Đạo,Xã Ngọc Sơn,Xã Hương Nhượng,Xã Vũ Bình,Xã Tự Do,Xã Yên Nghiệp,Xã Tân Mỹ,Xã Ân Nghĩa,Xã Ngọc Lâu',
            'Huyện Yên Thủy' => 'Thị trấn Hàng Trạm,Xã Lạc Sỹ,Xã Lạc Lương,Xã Bảo Hiệu,Xã Đa Phúc,Xã Hữu Lợi,Xã Lạc Thịnh,Xã Đoàn Kết,Xã Phú Lai,Xã Yên Trị,Xã Ngọc Lương',
            'Huyện Lạc Thủy' => 'Thị trấn Ba Hàng Đồi,Thị trấn Chi Nê,Xã Phú Nghĩa,Xã Phú Thành,Xã Hưng Thi,Xã Khoan Dụ,Xã Đồng Tâm,Xã Yên Bồng,Xã Thống Nhất,Xã An Bình',
        ],
        'Tỉnh Thái Nguyên' => [
            'Thành phố Thái Nguyên' => 'Phường Quán Triều,Phường Quang Vinh,Phường Túc Duyên,Phường Hoàng Văn Thụ,Phường Trưng Vương,Phường Quang Trung,Phường Phan Đình Phùng,Phường Tân Thịnh,Phường Thịnh Đán,Phường Đồng Quang,Phường Gia Sàng,Phường Tân Lập,Phường Cam Giá,Phường Phú Xá,Phường Hương Sơn,Phường Trung Thành,Phường Tân Thành,Phường Tân Long,Xã Phúc Hà,Xã Phúc Xuân,Xã Quyết Thắng,Xã Phúc Trìu,Xã Thịnh Đức,Phường Tích Lương,Xã Tân Cương,Xã Sơn Cẩm,Phường Chùa Hang,Xã Cao Ngạn,Xã Linh Sơn,Phường Đồng Bẩm,Xã Huống Thượng,Xã Đồng Liên',
            'Thành phố Sông Công' => 'Phường Lương Sơn,Phường Châu Sơn,Phường Mỏ Chè,Phường Cải Đan,Phường Thắng Lợi,Phường Phố Cò,Xã Tân Quang,Phường Bách Quang,Xã Bình Sơn,Xã Bá Xuyên',
            'Huyện Định Hóa' => 'Thị trấn Chợ Chu,Xã Linh Thông,Xã Lam Vỹ,Xã Quy Kỳ,Xã Tân Thịnh,Xã Kim Phượng,Xã Bảo Linh,Xã Phúc Chu,Xã Tân Dương,Xã Phượng Tiến,Xã Bảo Cường,Xã Đồng Thịnh,Xã Định Biên,Xã Thanh Định,Xã Trung Hội,Xã Trung Lương,Xã Bình Yên,Xã Điềm Mặc,Xã Phú Tiến,Xã Bộc Nhiêu,Xã Sơn Phú,Xã Phú Đình,Xã Bình Thành',
            'Huyện Phú Lương' => 'Thị trấn Giang Tiên,Thị trấn Đu,Xã Yên Ninh,Xã Yên Trạch,Xã Yên Đổ,Xã Yên Lạc,Xã Ôn Lương,Xã Động Đạt,Xã Phủ Lý,Xã Phú Đô,Xã Hợp Thành,Xã Tức Tranh,Xã Phấn Mễ,Xã Vô Tranh,Xã Cổ Lũng',
            'Huyện Đồng Hỷ' => 'Thị trấn Sông Cầu,Thị trấn Trại Cau,Xã Văn Lăng,Xã Tân Long,Xã Hòa Bình,Xã Quang Sơn,Xã Minh Lập,Xã Văn Hán,Xã Hóa Trung,Xã Khe Mo,Xã Cây Thị,Xã Hóa Thượng,Xã Hợp Tiến,Xã Tân Lợi,Xã Nam Hòa',
            'Huyện Võ Nhai' => 'Thị trấn Đình Cả,Xã Sảng Mộc,Xã Nghinh Tường,Xã Thần Xa,Xã Vũ Chấn,Xã Thượng Nung,Xã Phú Thượng,Xã Cúc Đường,Xã La Hiên,Xã Lâu Thượng,Xã Tràng Xá,Xã Phương Giao,Xã Liên Minh,Xã Dân Tiến,Xã Bình Long',
            'Huyện Đại Từ' => 'Thị trấn Hùng Sơn,Thị trấn Quân Chu,Xã Phúc Lương,Xã Minh Tiến,Xã Yên Lãng,Xã Đức Lương,Xã Phú Cường,Xã Na Mao,Xã Phú Lạc,Xã Tân Linh,Xã Phú Thịnh,Xã Phục Linh,Xã Phú Xuyên,Xã Bản Ngoại,Xã Tiên Hội,Xã Cù Vân,Xã Hà Thượng,Xã La Bằng,Xã Hoàng Nông,Xã Khôi Kỳ,Xã An Khánh,Xã Tân Thái,Xã Bình Thuận,Xã Lục Ba,Xã Mỹ Yên,Xã Vạn Thọ,Xã Văn Yên,Xã Ký Phú,Xã Cát Nê,Xã Quân Chu',
            'Thị xã Phổ Yên' => 'Phường Bãi Bông,Phường Bắc Sơn,Phường Ba Hàng,Xã Phúc Tân,Xã Phúc Thuận,Xã Hồng Tiến,Xã Minh Đức,Xã Đắc Sơn,Phường Đồng Tiến,Xã Thành Công,Xã Tiên Phong,Xã Vạn Phái,Xã Nam Tiến,Xã Tân Hương,Xã Đông Cao,Xã Trung Thành,Xã Tân Phú,Xã Thuận Thành',
            'Huyện Phú Bình' => 'Thị trấn Hương Sơn,Xã Bàn Đạt,Xã Tân Khánh,Xã Tân Kim,Xã Tân Thành,Xã Đào Xá,Xã Bảo Lý,Xã Thượng Đình,Xã Tân Hòa,Xã Nhã Lộng,Xã Điềm Thụy,Xã Xuân Phương,Xã Tân Đức,Xã Úc Kỳ,Xã Lương Phú,Xã Nga My,Xã Kha Sơn,Xã Thanh Ninh,Xã Dương Thành,Xã Hà Châu',
        ],
        'Tỉnh Lạng Sơn' => [
            'Thành phố Lạng Sơn' => 'Phường Hoàng Văn Thụ,Phường Tam Thanh,Phường Vĩnh Trại,Phường Đông Kinh,Phường Chi Lăng,Xã Hoàng Đồng,Xã Quảng Lạc,Xã Mai Pha',
            'Huyện Tràng Định' => 'Thị trấn Thất Khê,Xã Khánh Long,Xã Đoàn Kết,Xã Quốc Khánh,Xã Vĩnh Tiến,Xã Cao Minh,Xã Chí Minh,Xã Tri Phương,Xã Tân Tiến,Xã Tân Yên,Xã Đội Cấn,Xã Tân Minh,Xã Kim Đồng,Xã Chi Lăng,Xã Trung Thành,Xã Đại Đồng,Xã Đào Viên,Xã Đề Thám,Xã Kháng Chiến,Xã Hùng Sơn,Xã Quốc Việt,Xã Hùng Việt',
            'Huyện Bình Gia' => 'Xã Hưng Đạo,Xã Vĩnh Yên,Xã Hoa Thám,Xã Quý Hòa,Xã Hồng Phong,Xã Yên Lỗ,Xã Thiện Hòa,Xã Quang Trung,Xã Thiện Thuật,Xã Minh Khai,Xã Thiện Long,Xã Hoàng Văn Thụ,Xã Hòa Bình,Xã Mông Ân,Xã Tân Hòa,Thị trấn Bình Gia,Xã Hồng Thái,Xã Bình La,Xã Tân Văn',
            'Huyện Văn Lãng' => 'Thị trấn Na Sầm,Xã Trùng Khánh,Xã Bắc La,Xã Thụy Hùng,Xã Bắc Hùng,Xã Tân Tác,Xã Thanh Long,Xã Hội Hoan,Xã Bắc Việt,Xã Hoàng Việt,Xã Gia Miễn,Xã Thành Hòa,Xã Tân Thanh,Xã Tân Mỹ,Xã Hồng Thái,Xã  Hoàng Văn Thụ,Xã Nhạc Kỳ',
            'Huyện Cao Lộc' => 'Thị trấn Đồng Đăng,Thị trấn Cao Lộc,Xã Bảo Lâm,Xã Thanh Lòa,Xã Cao Lâu,Xã Thạch Đạn,Xã Xuất Lễ,Xã Hồng Phong,Xã Thụy Hùng,Xã Lộc Yên,Xã Phú Xá,Xã Bình Trung,Xã Hải Yến,Xã Hòa Cư,Xã Hợp Thành,Xã Công Sơn,Xã Gia Cát,Xã Mẫu Sơn,Xã Xuân Long,Xã Tân Liên,Xã Yên Trạch,Xã Tân Thành',
            'Huyện Văn Quan' => 'Thị trấn Văn Quan,Xã Trấn Ninh,Xã Liên Hội,Xã Hòa Bình,Xã Tú Xuyên,Xã Điềm He,Xã An Sơn,Xã Khánh Khê,Xã Lương Năng,Xã Đồng Giáp,Xã Bình Phúc,Xã Tràng Các,Xã Tân Đoàn,Xã Tri Lễ,Xã Tràng Phái,Xã Yên Phúc,Xã Hữu Lễ',
            'Huyện Bắc Sơn' => 'Thị trấn Bắc Sơn,Xã Long Đống,Xã Vạn Thủy,Xã Đồng ý,Xã Tân Tri,Xã Bắc Quỳnh,Xã Hưng Vũ,Xã Tân Lập,Xã Vũ Sơn,Xã Chiêu Vũ,Xã Tân Hương,Xã Chiến Thắng,Xã Vũ Lăng,Xã Trấn Yên,Xã Vũ Lễ,Xã Nhất Hòa,Xã Tân Thành,Xã Nhất Tiến',
            'Huyện Hữu Lũng' => 'Thị trấn Hữu Lũng,Xã Hữu Liên,Xã Yên Bình,Xã Quyết Thắng,Xã Hòa Bình,Xã Yên Thịnh,Xã Yên Sơn,Xã Thiện Tân,Xã Yên Vượng,Xã Minh Tiến,Xã Nhật Tiến,Xã Thanh Sơn,Xã Đồng Tân,Xã Cai Kinh,Xã Hòa Lạc,Xã Vân Nham,Xã Đồng Tiến,Xã Tân Thành,Xã Hòa Sơn,Xã Minh Sơn,Xã Hồ Sơn,Xã Sơn Hà,Xã Minh Hòa,Xã Hòa Thắng',
            'Huyện Chi Lăng' => 'Thị trấn Đồng Mỏ,Thị trấn Chi Lăng,Xã Vân An,Xã Vân Thủy,Xã Gia Lộc,Xã Bắc Thủy,Xã Chiến Thắng,Xã Mai Sao,Xã Bằng Hữu,Xã Thượng Cường,Xã Bằng Mạc,Xã Nhân Lý,Xã Lâm Sơn,Xã Liên Sơn,Xã Vạn Linh,Xã Hòa Bình,Xã Hữu Kiên,Xã Quan Sơn,Xã Y Tịch,Xã Chi Lăng',
            'Huyện Lộc Bình' => 'Thị trấn Na Dương,Thị trấn Lộc Bình,Xã Mẫu Sơn,Xã Yên Khoái,Xã Khánh Xuân,Xã Tú Mịch,Xã Hữu Khánh,Xã Đồng Bục,Xã Tam Gia,Xã Tú Đoạn,Xã Khuất Xá,Xã Tĩnh Bắc,Xã Thống Nhất,Xã Sàn Viên,Xã Đông Quan,Xã Minh Hiệp,Xã Hữu Lân,Xã Lợi Bác,Xã Nam Quan,Xã Xuân Dương,Xã Ái Quốc',
            'Huyện Đình Lập' => 'Thị trấn Đình Lập,Thị trấn NT Thái Bình,Xã Bắc Xa,Xã Bính Xá,Xã Kiên Mộc,Xã Đình Lập,Xã Thái Bình,Xã Cường Lợi,Xã Châu Sơn,Xã Lâm Ca,Xã Đồng Thắng,Xã Bắc Lãng',
        ],
        'Tỉnh Quảng Ninh' => [
            'Thành phố Hạ Long' => 'Phường Hà Khánh,Phường Hà Phong,Phường Hà Khẩu,Phường Cao Xanh,Phường Giếng Đáy,Phường Hà Tu,Phường Hà Trung,Phường Hà Lầm,Phường Bãi Cháy,Phường Cao Thắng,Phường Hùng Thắng,Phường Yết Kiêu,Phường Trần Hưng Đạo,Phường Hồng Hải,Phường Hồng Gai,Phường Bạch Đằng,Phường Hồng Hà,Phường Tuần Châu,Phường Việt Hưng,Phường Đại Yên,Phường Hoành Bồ,Xã Kỳ Thượng,Xã Đồng Sơn,Xã Tân Dân,Xã Đồng Lâm,Xã Hòa Bình,Xã Vũ Oai,Xã Dân Chủ,Xã Quảng La,Xã Bằng Cả,Xã Thống Nhất,Xã Sơn Dương,Xã Lê Lợi',
            'Thành phố Móng Cái' => 'Phường Ka Long,Phường Trần Phú,Phường Ninh Dương,Phường Hoà Lạc,Phường Trà Cổ,Xã Hải Sơn,Xã Bắc Sơn,Xã Hải Đông,Xã Hải Tiến,Phường Hải Yên,Xã Quảng Nghĩa,Phường Hải Hoà,Xã Hải Xuân,Xã Vạn Ninh,Phường Bình Ngọc,Xã Vĩnh Trung,Xã Vĩnh Thực',
            'Thành phố Cẩm Phả' => 'Phường Mông Dương,Phường Cửa Ông,Phường Cẩm Sơn,Phường Cẩm Đông,Phường Cẩm Phú,Phường Cẩm Tây,Phường Quang Hanh,Phường Cẩm Thịnh,Phường Cẩm Thủy,Phường Cẩm Thạch,Phường Cẩm Thành,Phường Cẩm Trung,Phường Cẩm Bình,Xã Cộng Hòa,Xã Cẩm Hải,Xã Dương Huy',
            'Thành phố Uông Bí' => 'Phường Vàng Danh,Phường Thanh Sơn,Phường Bắc Sơn,Phường Quang Trung,Phường Trưng Vương,Phường Nam Khê,Phường Yên Thanh,Xã Thượng Yên Công,Phường Phương Đông,Phường Phương Nam',
            'Huyện Bình Liêu' => 'Thị trấn Bình Liêu,Xã Hoành Mô,Xã Đồng Tâm,Xã Đồng Văn,Xã Vô Ngại,Xã Lục Hồn,Xã Húc Động',
            'Huyện Tiên Yên' => 'Thị trấn Tiên Yên,Xã Hà Lâu,Xã Đại Dực,Xã Phong Dụ,Xã Điền Xá,Xã Đông Ngũ,Xã Yên Than,Xã Đông Hải,Xã Hải Lạng,Xã Tiên Lãng,Xã Đồng Rui',
            'Huyện Đầm Hà' => 'Thị trấn Đầm Hà,Xã Quảng Lâm,Xã Quảng An,Xã Tân Bình,Xã Dực Yên,Xã Quảng Tân,Xã Đầm Hà,Xã Tân Lập,Xã Đại Bình',
            'Huyện Hải Hà' => 'Thị trấn Quảng Hà,Xã Quảng Đức,Xã Quảng Sơn,Xã Quảng Thành,Xã Quảng Thịnh,Xã Quảng Minh,Xã Quảng Chính,Xã Quảng Long,Xã Đường Hoa,Xã Quảng Phong,Xã Cái Chiên',
            'Huyện Ba Chẽ' => 'Thị trấn Ba Chẽ,Xã Thanh Sơn,Xã Thanh Lâm,Xã Đạp Thanh,Xã Nam Sơn,Xã Lương Mông,Xã Đồn Đạc,Xã Minh Cầm',
            'Huyện Vân Đồn' => 'Thị trấn Cái Rồng,Xã Đài Xuyên,Xã Bình Dân,Xã Vạn Yên,Xã Minh Châu,Xã Đoàn Kết,Xã Hạ Long,Xã Đông Xá,Xã Bản Sen,Xã Thắng Lợi,Xã Quan Lạn,Xã Ngọc Vừng',
            'Thị xã Đông Triều' => 'Phường Mạo Khê,Phường Đông Triều,Xã An Sinh,Xã Tràng Lương,Xã Bình Khê,Xã Việt Dân,Xã Tân Việt,Xã Bình Dương,Phường Đức Chính,Phường Tràng An,Xã Nguyễn Huệ,Xã Thủy An,Phường Xuân Sơn,Xã Hồng Thái Tây,Xã Hồng Thái Đông,Phường Hoàng Quế,Phường Yên Thọ,Phường Hồng Phong,Phường Kim Sơn,Phường Hưng Đạo,Xã Yên Đức',
            'Thị xã Quảng Yên' => 'Phường Quảng Yên,Phường Đông Mai,Phường Minh Thành,Xã Sông Khoai,Xã Hiệp Hòa,Phường Cộng Hòa,Xã Tiền An,Xã Hoàng Tân,Phường Tân An,Phường Yên Giang,Phường Nam Hoà,Phường Hà An,Xã Cẩm La,Phường Phong Hải,Phường Yên Hải,Xã Liên Hòa,Phường Phong Cốc,Xã Liên Vị,Xã Tiền Phong',
            'Huyện Cô Tô' => 'Thị trấn Cô Tô,Xã Đồng Tiến,Xã Thanh Lân',
        ],
        'Tỉnh Bắc Giang' => [
            'Thành phố Bắc Giang' => 'Phường Thọ Xương,Phường Trần Nguyên Hãn,Phường Ngô Quyền,Phường Hoàng Văn Thụ,Phường Trần Phú,Phường Mỹ Độ,Phường Lê Lợi,Xã Song Mai,Phường Xương Giang,Phường Đa Mai,Phường Dĩnh Kế,Xã Dĩnh Trì,Xã Tân Mỹ,Xã Đồng Sơn,Xã Tân Tiến,Xã Song Khê',
            'Huyện Yên Thế' => 'Xã Đồng Tiến,Xã Canh Nậu,Xã Xuân Lương,Xã Tam Tiến,Xã Đồng Vương,Xã Đồng Hưu,Xã Đồng Tâm,Xã Tam Hiệp,Xã Tiến Thắng,Xã Hồng Kỳ,Xã Đồng Lạc,Xã Đông Sơn,Xã Tân Hiệp,Xã Hương Vĩ,Xã Đồng Kỳ,Xã An Thượng,Thị trấn Phồn Xương,Xã Tân Sỏi,Thị trấn Bố Hạ',
            'Huyên Tân Yên' => 'Xã Lan Giới,Thị trấn Nhã Nam,Xã Tân Trung,Xã Đại Hóa,Xã Quang Tiến,Xã Phúc Sơn,Xã An Dương,Xã Phúc Hòa,Xã Liên Sơn,Xã Hợp Đức,Xã Lam Cốt,Xã Cao Xá,Thị trấn Cao Thượng,Xã Việt Ngọc,Xã Song Vân,Xã Ngọc Châu,Xã Ngọc Vân,Xã Việt Lập,Xã Liên Chung,Xã Ngọc Thiện,Xã Ngọc Lý,Xã Quế Nham',
            'Huyện Lạng Giang' => 'Thị trấn Vôi,Xã Nghĩa Hòa,Xã Nghĩa Hưng,Xã Quang Thịnh,Xã Hương Sơn,Xã Đào Mỹ,Xã Tiên Lục,Xã An Hà,Thị trấn Kép,Xã Mỹ Hà,Xã Hương Lạc,Xã Dương Đức,Xã Tân Thanh,Xã Yên Mỹ,Xã Tân Hưng,Xã Mỹ Thái,Xã Xương Lâm,Xã Xuân Hương,Xã Tân Dĩnh,Xã Đại Lâm,Xã Thái Đào',
            'Huyện Lục Nam' => 'Thị trấn Đồi Ngô,Xã Đông Hưng,Xã Đông Phú,Xã Tam Dị,Xã Bảo Sơn,Xã Bảo Đài,Xã Thanh Lâm,Xã Tiên Nha,Xã Trường Giang,Xã Phương Sơn,Xã Chu Điện,Xã Cương Sơn,Xã Nghĩa Phương,Xã Vô Tranh,Xã Bình Sơn,Xã Lan Mẫu,Xã Yên Sơn,Xã Khám Lạng,Xã Huyền Sơn,Xã Trường Sơn,Xã Lục Sơn,Xã Bắc Lũng,Xã Vũ Xá,Xã Cẩm Lý,Xã Đan Hội',
            'Huyện Lục Ngạn' => 'Thị trấn Chũ,Xã Cấm Sơn,Xã Tân Sơn,Xã Phong Minh,Xã Phong Vân,Xã Xa Lý,Xã Hộ Đáp,Xã Sơn Hải,Xã Thanh Hải,Xã Kiên Lao,Xã Biên Sơn,Xã Kiên Thành,Xã Hồng Giang,Xã Kim Sơn,Xã Tân Hoa,Xã Giáp Sơn,Xã Biển Động,Xã Quý Sơn,Xã Trù Hựu,Xã Phì Điền,Xã Tân Quang,Xã Đồng Cốc,Xã Tân Lập,Xã Phú Nhuận,Xã Mỹ An,Xã Nam Dương,Xã Tân Mộc,Xã Đèo Gia,Xã Phượng Sơn',
            'Huyện Sơn Động' => 'Thị trấn An Châu,Thị trấn Tây Yên Tử,Xã Vân Sơn,Xã Hữu Sản,Xã Đại Sơn,Xã Phúc Sơn,Xã Giáo Liêm,Xã Cẩm Đàn,Xã An Lạc,Xã Vĩnh An,Xã Yên Định,Xã Lệ Viễn,Xã An Bá,Xã Tuấn Đạo,Xã Dương Hưu,Xã Long Sơn,Xã Thanh Luận',
            'Huyện Yên Dũng' => 'Thị trấn Nham Biền,Thị trấn Tân An,Xã Lão Hộ,Xã Hương Gián,Xã Quỳnh Sơn,Xã Nội Hoàng,Xã Tiền Phong,Xã Xuân Phú,Xã Tân Liễu,Xã Trí Yên,Xã Lãng Sơn,Xã Yên Lư,Xã Tiến Dũng,Xã Đức Giang,Xã Cảnh Thụy,Xã Tư Mại,Xã Đồng Việt,Xã Đồng Phúc',
            'Huyện Việt Yên' => 'Xã Thượng Lan,Xã Việt Tiến,Xã Nghĩa Trung,Xã Minh Đức,Xã Hương Mai,Xã Tự Lạn,Thị trấn Bích Động,Xã Trung Sơn,Xã Hồng Thái,Xã Tiên Sơn,Xã Tăng Tiến,Xã Quảng Minh,Thị trấn Nếnh,Xã Ninh Sơn,Xã Vân Trung,Xã Vân Hà,Xã Quang Châu',
            'Huyện Hiệp Hòa' => 'Xã Đồng Tân,Xã Thanh Vân,Xã Hoàng Lương,Xã Hoàng Vân,Xã Hoàng Thanh,Xã Hoàng An,Xã Ngọc Sơn,Xã Thái Sơn,Xã Hòa Sơn,Thị trấn Thắng,Xã Quang Minh,Xã Lương Phong,Xã Hùng Sơn,Xã Đại Thành,Xã Thường Thắng,Xã Hợp Thịnh,Xã Danh Thắng,Xã Mai Trung,Xã Đoan Bái,Xã Bắc Lý,Xã Xuân Cẩm,Xã Hương Lâm,Xã Đông Lỗ,Xã Châu Minh,Xã Mai Đình',
        ],
        'Tỉnh Phú Thọ' => [
            'Thành phố Việt Trì' => 'Phường Dữu Lâu,Phường Vân Cơ,Phường Nông Trang,Phường Tân Dân,Phường Gia Cẩm,Phường Tiên Cát,Phường Thọ Sơn,Phường Thanh Miếu,Phường Bạch Hạc,Phường Bến Gót,Phường Vân Phú,Xã Phượng Lâu,Xã Thụy Vân,Phường Minh Phương,Xã Trưng Vương,Phường Minh Nông,Xã Sông Lô,Xã Kim Đức,Xã Hùng Lô,Xã Hy Cương,Xã Chu Hóa,Xã Thanh Đình',
            'Thị xã Phú Thọ' => 'Phường Hùng Vương,Phường Phong Châu,Phường Âu Cơ,Xã Hà Lộc,Xã Phú Hộ,Xã Văn Lung,Xã Thanh Minh,Xã Hà Thạch,Phường Thanh Vinh',
            'Huyện Đoan Hùng' => 'Thị trấn Đoan Hùng,Xã Hùng Xuyên,Xã Bằng Luân,Xã Vân Du,Xã Phú Lâm,Xã Minh Lương,Xã Bằng Doãn,Xã Chí Đám,Xã Phúc Lai,Xã Ngọc Quan,Xã Hợp Nhất,Xã Sóc Đăng,Xã Tây Cốc,Xã Yên Kiện,Xã Hùng Long,Xã Vụ Quang,Xã Vân Đồn,Xã Tiêu Sơn,Xã Minh Tiến,Xã Minh Phú,Xã Chân Mộng,Xã Ca Đình',
            'Huyện Hạ Hòa' => 'Thị trấn Hạ Hoà,Xã Đại Phạm,Xã Đan Thượng,Xã Hà Lương,Xã Tứ Hiệp,Xã Hiền Lương,Xã Phương Viên,Xã Gia Điền,Xã Ấm Hạ,Xã Hương Xạ,Xã Xuân Áng,Xã Yên Kỳ,Xã Minh Hạc,Xã Lang Sơn,Xã Bằng Giã,Xã Yên Luật,Xã Vô Tranh,Xã Văn Lang,Xã Minh Côi,Xã Vĩnh Chân',
            'Huyện Thanh Ba' => 'Thị trấn Thanh Ba,Xã Vân Lĩnh,Xã Đông Lĩnh,Xã Đại An,Xã Hanh Cù,Xã Đồng Xuân,Xã Quảng Yên,Xã Ninh Dân,Xã Võ Lao,Xã Khải Xuân,Xã Mạn Lạn,Xã Hoàng Cương,Xã Chí Tiên,Xã Đông Thành,Xã Sơn Cương,Xã Thanh Hà,Xã Đỗ Sơn,Xã Đỗ Xuyên,Xã Lương Lỗ',
            'Huyện Phù Ninh' => 'Thị trấn Phong Châu,Xã Phú Mỹ,Xã Lệ Mỹ,Xã Liên Hoa,Xã Trạm Thản,Xã Trị Quận,Xã Trung Giáp,Xã Tiên Phú,Xã Hạ Giáp,Xã Bảo Thanh,Xã Phú Lộc,Xã Gia Thanh,Xã Tiên Du,Xã Phú Nham,Xã An Đạo,Xã Bình Phú,Xã Phù Ninh',
            'Huyện Yên Lập' => 'Thị trấn Yên Lập,Xã Mỹ Lung,Xã Mỹ Lương,Xã Lương Sơn,Xã Xuân An,Xã Xuân Viên,Xã Xuân Thủy,Xã Trung Sơn,Xã Hưng Long,Xã Nga Hoàng,Xã Đồng Lạc,Xã Thượng Long,Xã Đồng Thịnh,Xã Phúc Khánh,Xã Minh Hòa,Xã Ngọc Lập,Xã Ngọc Đồng',
            'Huyện Cẩm Khê' => 'Thị trấn Cẩm Khê,Xã Tiên Lương,Xã Tuy Lộc,Xã Ngô Xá,Xã Minh Tân,Xã Phượng Vĩ,Xã Thụy Liễu,Xã Tùng Khê,Xã Tam Sơn,Xã Văn Bán,Xã Cấp Dẫn,Xã Xương Thịnh,Xã Phú Khê,Xã Sơn Tình,Xã Yên Tập,Xã Hương Lung,Xã Tạ Xá,Xã Phú Lạc,Xã Chương Xá,Xã Hùng Việt,Xã Văn Khúc,Xã Yên Dưỡng,Xã Điêu Lương,Xã Đồng Lương',
            'Huyện Tam Nông' => 'Thị trấn Hưng Hoá,Xã Hiền Quan,Xã Bắc Sơn,Xã Thanh Uyên,Xã Lam Sơn,Xã Vạn Xuân,Xã Quang Húc,Xã Hương Nộn,Xã Tề Lễ,Xã Thọ Văn,Xã Dị Nậu,Xã Dân Quyền',
            'Huyện Lâm Thao' => 'Thị trấn Lâm Thao,Xã Tiên Kiên,Thị trấn Hùng Sơn,Xã Xuân Lũng,Xã Xuân Huy,Xã Thạch Sơn,Xã Sơn Vi,Xã Phùng Nguyên,Xã Cao Xá,Xã Vĩnh Lại,Xã Tứ Xã,Xã Bản Nguyên',
            'Huyện Thanh Sơn' => 'Thị trấn Thanh Sơn,Xã Sơn Hùng,Xã Địch Quả,Xã Giáp Lai,Xã Thục Luyện,Xã Võ Miếu,Xã Thạch Khoán,Xã Cự Thắng,Xã Tất Thắng,Xã Văn Miếu,Xã Cự Đồng,Xã Thắng Sơn,Xã Tân Minh,Xã Hương Cần,Xã Khả Cửu,Xã Đông Cửu,Xã Tân Lập,Xã Yên Lãng,Xã Yên Lương,Xã Thượng Cửu,Xã Lương Nha,Xã Yên Sơn,Xã Tinh Nhuệ',
            'Huyện Thanh Thủy' => 'Xã Đào Xá,Xã Thạch Đồng,Xã Xuân Lộc,Xã Tân Phương,Thị trấn Thanh Thủy,Xã Sơn Thủy,Xã Bảo Yên,Xã Đoan Hạ,Xã Đồng Trung,Xã Hoàng Xá,Xã Tu Vũ',
            'Huyện Tân Sơn' => 'Xã Thu Cúc,Xã Thạch Kiệt,Xã Thu Ngạc,Xã Kiệt Sơn,Xã Đồng Sơn,Xã Lai Đồng,Xã Tân Phú,Xã Mỹ Thuận,Xã Tân Sơn,Xã Xuân Đài,Xã Minh Đài,Xã Văn Luông,Xã Xuân Sơn,Xã Long Cốc,Xã Kim Thượng,Xã Tam Thanh,Xã Vinh Tiền',
        ],
        'Tỉnh Vĩnh Phúc' => [
            'Thành phố Vĩnh Yên' => 'Phường Tích Sơn,Phường Liên Bảo,Phường Hội Hợp,Phường Đống Đa,Phường Ngô Quyền,Phường Đồng Tâm,Xã Định Trung,Phường Khai Quang,Xã Thanh Trù',
            'Thành phố Phúc Yên' => 'Phường Trưng Trắc,Phường Hùng Vương,Phường Trưng Nhị,Phường Phúc Thắng,Phường Xuân Hoà,Phường Đồng Xuân,Xã Ngọc Thanh,Xã Cao Minh,Phường Nam Viêm,Phường Tiền Châu',
            'Huyện Lập Thạch' => 'Thị trấn Lập Thạch,Xã Quang Sơn,Xã Ngọc Mỹ,Xã Hợp Lý,Xã Bắc Bình,Xã Thái Hòa,Thị trấn Hoa Sơn,Xã Liễn Sơn,Xã Xuân Hòa,Xã Vân Trục,Xã Liên Hòa,Xã Tử Du,Xã Bàn Giản,Xã Xuân Lôi,Xã Đồng Ích,Xã Tiên Lữ,Xã Văn Quán,Xã Đình Chu,Xã Triệu Đề,Xã Sơn Đông',
            'Huyện Tam Dương' => 'Thị trấn Hợp Hòa,Xã Hoàng Hoa,Xã Đồng Tĩnh,Xã Kim Long,Xã Hướng Đạo,Xã Đạo Tú,Xã An Hòa,Xã Thanh Vân,Xã Duy Phiên,Xã Hoàng Đan,Xã Hoàng Lâu,Xã Vân Hội,Xã Hợp Thịnh',
            'Huyện Tam Đảo' => 'Thị trấn Tam Đảo,Thị trấn Hợp Châu,Xã Đạo Trù,Xã Yên Dương,Xã Bồ Lý,Thị trấn Đại Đình,Xã Tam Quan,Xã Hồ Sơn,Xã Minh Quang',
            'Huyện Bình Xuyên' => 'Thị trấn Hương Canh,Thị trấn Gia Khánh,Xã Trung Mỹ,Thị trấn Bá Hiến,Xã Thiện Kế,Xã Hương Sơn,Xã Tam Hợp,Xã Quất Lưu,Xã Sơn Lôi,Thị trấn Đạo Đức,Xã Tân Phong,Thị trấn Thanh Lãng,Xã Phú Xuân',
            'Huyện Yên Lạc' => 'Thị trấn Yên Lạc,Xã Đồng Cương,Xã Đồng Văn,Xã Bình Định,Xã Trung Nguyên,Xã Tề Lỗ,Xã Tam Hồng,Xã Yên Đồng,Xã Văn Tiến,Xã Nguyệt Đức,Xã Yên Phương,Xã Hồng Phương,Xã Trung Kiên,Xã Liên Châu,Xã Đại Tự,Xã Hồng Châu,Xã Trung Hà',
            'Huyện Vĩnh Tường' => 'Thị trấn Vĩnh Tường,Xã Kim Xá,Xã Yên Bình,Xã Chấn Hưng,Xã Nghĩa Hưng,Xã Yên Lập,Xã Việt Xuân,Xã Bồ Sao,Xã Đại Đồng,Xã Tân Tiến,Xã Lũng Hoà,Xã Cao Đại,Thị Trấn Thổ Tang,Xã Vĩnh Sơn,Xã Bình Dương,Xã Tân Phú,Xã Thượng Trưng,Xã Vũ Di,Xã Lý Nhân,Xã Tuân Chính,Xã Vân Xuân,Xã Tam Phúc,Thị trấn Tứ Trưng,Xã Ngũ Kiên,Xã An Tường,Xã Vĩnh Thịnh,Xã Phú Đa,Xã Vĩnh Ninh',
            'Huyện Sông Lô' => 'Xã Lãng Công,Xã Quang Yên,Xã Bạch Lưu,Xã Hải Lựu,Xã Đồng Quế,Xã Nhân Đạo,Xã Đôn Nhân,Xã Phương Khoan,Xã Tân Lập,Xã Nhạo Sơn,Thị trấn Tam Sơn,Xã Như Thụy,Xã Yên Thạch,Xã Đồng Thịnh,Xã Tứ Yên,Xã Đức Bác,Xã Cao Phong',
        ],
        'Tỉnh Bắc Ninh' => [
            'Thành phố Bắc Ninh' => 'Phường Vũ Ninh,Phường Đáp Cầu,Phường Thị Cầu,Phường Kinh Bắc,Phường Vệ An,Phường Tiền An,Phường Đại Phúc,Phường Ninh Xá,Phường Suối Hoa,Phường Võ Cường,Phường Hòa Long,Phường Vạn An,Phường Khúc Xuyên,Phường Phong Khê,Phường Kim Chân,Phường Vân Dương,Phường Nam Sơn,Phường Khắc Niệm,Phường Hạp Lĩnh',
            'Huyện Yên Phong' => 'Thị trấn Chờ,Xã Dũng Liệt,Xã Tam Đa,Xã Tam Giang,Xã Yên Trung,Xã Thụy Hòa,Xã Hòa Tiến,Xã Đông Tiến,Xã Yên Phụ,Xã Trung Nghĩa,Xã Đông Phong,Xã Long Châu,Xã Văn Môn,Xã Đông Thọ',
            'Huyện Quế Võ' => 'Thị trấn Phố Mới,Xã Việt Thống,Xã Đại Xuân,Xã Nhân Hòa,Xã Bằng An,Xã Phương Liễu,Xã Quế Tân,Xã Phù Lương,Xã Phù Lãng,Xã Phượng Mao,Xã Việt Hùng,Xã Ngọc Xá,Xã Châu Phong,Xã Bồng Lai,Xã Cách Bi,Xã Đào Viên,Xã Yên Giả,Xã Mộ Đạo,Xã Đức Long,Xã Chi Lăng,Xã Hán Quảng',
            'Huyện Tiên Du' => 'Thị trấn Lim,Xã Phú Lâm,Xã Nội Duệ,Xã Liên Bão,Xã Hiên Vân,Xã Hoàn Sơn,Xã Lạc Vệ,Xã Việt Đoàn,Xã Phật Tích,Xã Tân Chi,Xã Đại Đồng,Xã Tri Phương,Xã Minh Đạo,Xã Cảnh Hưng',
            'Thị xã Từ Sơn' => 'Phường Đông Ngàn,Phường Tam Sơn,Phường Hương Mạc,Phường Tương Giang,Phường Phù Khê,Phường Đồng Kỵ,Phường Trang Hạ,Phường Đồng Nguyên,Phường Châu Khê,Phường Tân Hồng,Phường Đình Bảng,Phường Phù Chẩn',
            'Huyện Thuận Thành' => 'Thị trấn Hồ,Xã Hoài Thượng,Xã Đại Đồng Thành,Xã Mão Điền,Xã Song Hồ,Xã Đình Tổ,Xã An Bình,Xã Trí Quả,Xã Gia Đông,Xã Thanh Khương,Xã Trạm Lộ,Xã Xuân Lâm,Xã Hà Mãn,Xã Ngũ Thái,Xã Nguyệt Đức,Xã Ninh Xá,Xã Nghĩa Đạo,Xã Song Liễu',
            'Huyện Gia Bình' => 'Thị trấn Gia Bình,Xã Vạn Ninh,Xã Thái Bảo,Xã Giang Sơn,Xã Cao Đức,Xã Đại Lai,Xã Song Giang,Xã Bình Dương,Xã Lãng Ngâm,Xã Nhân Thắng,Xã Xuân Lai,Xã Đông Cứu,Xã Đại Bái,Xã Quỳnh Phú',
            'Huyện Lương Tài' => 'Thị trấn Thứa,Xã An Thịnh,Xã Trung Kênh,Xã Phú Hòa,Xã Mỹ Hương,Xã Tân Lãng,Xã Quảng Phú,Xã Trừng Xá,Xã Lai Hạ,Xã Trung Chính,Xã Minh Tân,Xã Bình Định,Xã Phú Lương,Xã Lâm Thao',
        ],
        'Tỉnh Hải Dương' => [
            'Thành phố Hải Dương' => 'Phường Cẩm Thượng,Phường Bình Hàn,Phường Ngọc Châu,Phường Nhị Châu,Phường Quang Trung,Phường Nguyễn Trãi,Phường Phạm Ngũ Lão,Phường Trần Hưng Đạo,Phường Trần Phú,Phường Thanh Bình,Phường Tân Bình,Phường Lê Thanh Nghị,Phường Hải Tân,Phường Tứ Minh,Phường Việt Hoà,Phường Ái Quốc,Xã An Thượng,Phường Nam Đồng,Xã Quyết Thắng,Xã Tiền Tiến,Phường Thạch Khôi,Xã Liên Hồng,Phường Tân Hưng,Xã Gia Xuyên,Xã Ngọc Sơn',
            'Thành phố Chí Linh' => 'Phường Phả Lại,Phường Sao Đỏ,Phường Bến Tắm,Xã Hoàng Hoa Thám,Xã Bắc An,Xã Hưng Đạo,Xã Lê Lợi,Phường Hoàng Tiến,Phường Cộng Hoà,Phường Hoàng Tân,Phường Cổ Thành,Phường Văn An,Phường Chí Minh,Phường Văn Đức,Phường Thái Học,Xã Nhân Huệ,Phường An Lạc,Phường Đồng Lạc,Phường Tân Dân',
            'Huyện Nam Sách' => 'Thị trấn Nam Sách,Xã Nam Hưng,Xã Nam Tân,Xã Hợp Tiến,Xã Hiệp Cát,Xã Thanh Quang,Xã Quốc Tuấn,Xã Nam Chính,Xã An Bình,Xã Nam Trung,Xã An Sơn,Xã Cộng Hòa,Xã Thái Tân,Xã An Lâm,Xã Phú Điền,Xã Nam Hồng,Xã Hồng Phong,Xã Đồng Lạc,Xã Minh Tân',
            'Thị xã Kinh Môn' => 'Phường An Lưu,Xã Bạch Đằng,Phường Thất Hùng,Xã Lê Ninh,Xã Hoành Sơn,Phường Phạm Thái,Phường Duy Tân,Phường Tân Dân,Phường Minh Tân,Xã Quang Thành,Xã Hiệp Hòa,Phường Phú Thứ,Xã Thăng Long,Xã Lạc Long,Phường An Sinh,Phường Hiệp Sơn,Xã Thượng Quận,Phường An Phụ,Phường Hiệp An,Phường Long Xuyên,Phường Thái Thịnh,Phường Hiến Thành,Xã Minh Hòa',
            'Huyện Kim Thành' => 'Thị trấn Phú Thái,Xã Lai Vu,Xã Cộng Hòa,Xã Thượng Vũ,Xã Cổ Dũng,Xã Tuấn Việt,Xã Kim Xuyên,Xã Phúc Thành A,Xã Ngũ Phúc,Xã Kim Anh,Xã Kim Liên,Xã Kim Tân,Xã Kim Đính,Xã Bình Dân,Xã Tam Kỳ,Xã Đồng Cẩm,Xã Liên Hòa,Xã Đại Đức',
            'Huyện Thanh Hà' => 'Thị trấn Thanh Hà,Xã Hồng Lạc,Xã Việt Hồng,Xã Tân Việt,Xã Cẩm Chế,Xã Thanh An,Xã Thanh Lang,Xã Tân An,Xã Liên Mạc,Xã Thanh Hải,Xã Thanh Khê,Xã Thanh Xá,Xã Thanh Xuân,Xã Thanh Thủy,Xã An Phượng,Xã Thanh Sơn,Xã Thanh Quang,Xã Thanh Hồng,Xã Thanh Cường,Xã Vĩnh Lập',
            'Huyện Cẩm Giàng' => 'Thị trấn Cẩm Giang,Thị trấn Lai Cách,Xã Cẩm Hưng,Xã Cẩm Hoàng,Xã Cẩm Văn,Xã Ngọc Liên,Xã Thạch Lỗi,Xã Cẩm Vũ,Xã Đức Chính,Xã Định Sơn,Xã Lương Điền,Xã Cao An,Xã Tân Trường,Xã Cẩm Phúc,Xã Cẩm Điền,Xã Cẩm Đông,Xã Cẩm Đoài',
            'Huyện Bình Giang' => 'Thị trấn Kẻ Sặt,Xã Vĩnh Hưng,Xã Hùng Thắng,Xã Vĩnh Hồng,Xã Long Xuyên,Xã Tân Việt,Xã Thúc Kháng,Xã Tân Hồng,Xã Bình Minh,Xã Hồng Khê,Xã Thái Học,Xã Cổ Bì,Xã Nhân Quyền,Xã Thái Dương,Xã Thái Hòa,Xã Bình Xuyên',
            'Huyện Gia Lộc' => 'Thị trấn Gia Lộc,Xã Thống Nhất,Xã Yết Kiêu,Xã Gia Tân,Xã Tân Tiến,Xã Gia Khánh,Xã Gia Lương,Xã Lê Lợi,Xã Toàn Thắng,Xã Hoàng Diệu,Xã Hồng Hưng,Xã Phạm Trấn,Xã Đoàn Thượng,Xã Thống Kênh,Xã Quang Minh,Xã Đồng Quang,Xã Nhật Tân,Xã Đức Xương',
            'Huyện Tứ Kỳ' => 'Thị trấn Tứ Kỳ,Xã Đại Sơn,Xã Hưng Đạo,Xã Ngọc Kỳ,Xã Bình Lăng,Xã Chí Minh,Xã Tái Sơn,Xã Quang Phục,Xã Dân Chủ,Xã Tân Kỳ,Xã Quang Khải,Xã Đại Hợp,Xã Quảng Nghiệp,Xã An Thanh,Xã Minh Đức,Xã Văn Tố,Xã Quang Trung,Xã Phượng Kỳ,Xã Cộng Lạc,Xã Tiên Động,Xã Nguyên Giáp,Xã Hà Kỳ,Xã Hà Thanh',
            'Huyện Ninh Giang' => 'Thị trấn Ninh Giang,Xã Ứng Hoè,Xã Nghĩa An,Xã Hồng Đức,Xã An Đức,Xã Vạn Phúc,Xã Tân Hương,Xã Vĩnh Hòa,Xã Đông Xuyên,Xã Tân Phong,Xã Ninh Hải,Xã Đồng Tâm,Xã Tân Quang,Xã Kiến Quốc,Xã Hồng Dụ,Xã Văn Hội,Xã Hồng Phong,Xã Hiệp Lực,Xã Hồng Phúc,Xã Hưng Long',
            'Huyện Thanh Miện' => 'Thị trấn Thanh Miện,Xã Thanh Tùng,Xã Phạm Kha,Xã Ngô Quyền,Xã Đoàn Tùng,Xã Hồng Quang,Xã Tân Trào,Xã Lam Sơn,Xã Đoàn Kết,Xã Lê Hồng,Xã Tứ Cường,Xã Ngũ Hùng,Xã Cao Thắng,Xã Chi Lăng Bắc,Xã Chi Lăng Nam,Xã Thanh Giang,Xã Hồng Phong',
        ],
        'Thành phố Hải Phòng' => [
            'Quận Hồng Bàng' => 'Phường Quán Toan,Phường Hùng Vương,Phường Sở Dầu,Phường Thượng Lý,Phường Hạ Lý,Phường Minh Khai,Phường Trại Chuối,Phường Hoàng Văn Thụ,Phường Phan Bội Châu',
            'Quận Ngô Quyền' => 'Phường Máy Chai,Phường Máy Tơ,Phường Vạn Mỹ,Phường Cầu Tre,Phường Lạc Viên,Phường Gia Viên,Phường Đông Khê,Phường Cầu Đất,Phường Lê Lợi,Phường Đằng Giang,Phường Lạch Tray,Phường Đổng Quốc Bình',
            'Quận Lê Chân' => 'Phường Cát Dài,Phường An Biên,Phường Lam Sơn,Phường An Dương,Phường Trần Nguyên Hãn,Phường Hồ Nam,Phường Trại Cau,Phường Dư Hàng,Phường Hàng Kênh,Phường Đông Hải,Phường Niệm Nghĩa,Phường Nghĩa Xá,Phường Dư Hàng Kênh,Phường Kênh Dương,Phường Vĩnh Niệm',
            'Quận Hải An' => 'Phường Đông Hải 1,Phường Đông Hải 2,Phường Đằng Lâm,Phường Thành Tô,Phường Đằng Hải,Phường Nam Hải,Phường Cát Bi,Phường Tràng Cát',
            'Quận Kiến An' => 'Phường Quán Trữ,Phường Lãm Hà,Phường Đồng Hoà,Phường Bắc Sơn,Phường Nam Sơn,Phường Ngọc Sơn,Phường Trần Thành Ngọ,Phường Văn Đẩu,Phường Phù Liễn,Phường Tràng Minh',
            'Quận Đồ Sơn' => 'Phường Ngọc Xuyên,Phường Hải Sơn,Phường Vạn Hương,Phường Minh Đức,Phường Bàng La,Phường Hợp Đức',
            'Quận Dương Kinh' => 'Phường Đa Phúc,Phường Hưng Đạo,Phường Anh Dũng,Phường Hải Thành,Phường Hoà Nghĩa,Phường Tân Thành',
            'Huyện Thủy Nguyên' => 'Thị trấn Núi Đèo,Thị trấn Minh Đức,Xã Lại Xuân,Xã An Sơn,Xã Kỳ Sơn,Xã Liên Khê,Xã Lưu Kiếm,Xã Lưu Kỳ,Xã Gia Minh,Xã Gia Đức,Xã Minh Tân,Xã Phù Ninh,Xã Quảng Thanh,Xã Chính Mỹ,Xã Kênh Giang,Xã Hợp Thành,Xã Cao Nhân,Xã Mỹ Đồng,Xã Đông Sơn,Xã Hoà Bình,Xã Trung Hà,Xã An Lư,Xã Thuỷ Triều,Xã Ngũ Lão,Xã Phục Lễ,Xã Tam Hưng,Xã Phả Lễ,Xã Lập Lễ,Xã Kiền Bái,Xã Thiên Hương,Xã Thuỷ Sơn,Xã Thuỷ Đường,Xã Hoàng Động,Xã Lâm Động,Xã Hoa Động,Xã Tân Dương,Xã Dương Quan',
            'Huyện An Dương' => 'Thị trấn An Dương,Xã Lê Thiện,Xã Đại Bản,Xã An Hoà,Xã Hồng Phong,Xã Tân Tiến,Xã An Hưng,Xã An Hồng,Xã Bắc Sơn,Xã Nam Sơn,Xã Lê Lợi,Xã Đặng Cương,Xã Đồng Thái,Xã Quốc Tuấn,Xã An Đồng,Xã Hồng Thái',
            'Huyện An Lão' => 'Thị trấn An Lão,Xã Bát Trang,Xã Trường Thọ,Xã Trường Thành,Xã An Tiến,Xã Quang Hưng,Xã Quang Trung,Xã Quốc Tuấn,Xã An Thắng,Thị trấn Trường Sơn,Xã Tân Dân,Xã Thái Sơn,Xã Tân Viên,Xã Mỹ Đức,Xã Chiến Thắng,Xã An Thọ,Xã An Thái',
            'Huyện Kiến Thụy' => 'Thị trấn Núi Đối,Xã Đông Phương,Xã Thuận Thiên,Xã Hữu Bằng,Xã Đại Đồng,Xã Ngũ Phúc,Xã Kiến Quốc,Xã Du Lễ,Xã Thuỵ Hương,Xã Thanh Sơn,Xã Minh Tân,Xã Đại Hà,Xã Ngũ Đoan,Xã Tân Phong,Xã Tân Trào,Xã Đoàn Xá,Xã Tú Sơn,Xã Đại Hợp',
            'Huyện Tiên Lãng' => 'Thị trấn Tiên Lãng,Xã Đại Thắng,Xã Tiên Cường,Xã Tự Cường,Xã Quyết Tiến,Xã Khởi Nghĩa,Xã Tiên Thanh,Xã Cấp Tiến,Xã Kiến Thiết,Xã Đoàn Lập,Xã Bạch Đằng,Xã Quang Phục,Xã Toàn Thắng,Xã Tiên Thắng,Xã Tiên Minh,Xã Bắc Hưng,Xã Nam Hưng,Xã Hùng Thắng,Xã Tây Hưng,Xã Đông Hưng,Xã Vinh Quang',
            'Huyện Vĩnh Bảo' => 'Thị trấn Vĩnh Bảo,Xã Dũng Tiến,Xã Giang Biên,Xã Thắng Thuỷ,Xã Trung Lập,Xã Việt Tiến,Xã Vĩnh An,Xã Vĩnh Long,Xã Hiệp Hoà,Xã Hùng Tiến,Xã An Hoà,Xã Tân Hưng,Xã Tân Liên,Xã Nhân Hoà,Xã Tam Đa,Xã Hưng Nhân,Xã Vinh Quang,Xã Đồng Minh,Xã Thanh Lương,Xã Liên Am,Xã Lý Học,Xã Tam Cường,Xã Hoà Bình,Xã Tiền Phong,Xã Vĩnh Phong,Xã Cộng Hiền,Xã Cao Minh,Xã Cổ Am,Xã Vĩnh Tiến,Xã Trấn Dương',
            'Huyện Cát Hải' => 'Thị trấn Cát Bà,Thị trấn Cát Hải,Xã Nghĩa Lộ,Xã Đồng Bài,Xã Hoàng Châu,Xã Văn Phong,Xã Phù Long,Xã Gia Luận,Xã Hiền Hào,Xã Trân Châu,Xã Việt Hải,Xã Xuân Đám',
            'Huyện Bạch Long Vĩ' => null,
        ],
        'Tỉnh Hưng Yên' => [
            'Thành phố Hưng Yên' => 'Phường Lam Sơn,Phường Hiến Nam,Phường An Tảo,Phường Lê Lợi,Phường Minh Khai,Phường Quang Trung,Phường Hồng Châu,Xã Trung Nghĩa,Xã Liên Phương,Xã Hồng Nam,Xã Quảng Châu,Xã Bảo Khê,Xã Phú Cường,Xã Hùng Cường,Xã Phương Chiểu,Xã Tân Hưng,Xã Hoàng Hanh',
            'Huyện Văn Lâm' => 'Thị trấn Như Quỳnh,Xã Lạc Đạo,Xã Chỉ Đạo,Xã Đại Đồng,Xã Việt Hưng,Xã Tân Quang,Xã Đình Dù,Xã Minh Hải,Xã Lương Tài,Xã Trưng Trắc,Xã Lạc Hồng',
            'Huyện Văn Giang' => 'Thị trấn Văn Giang,Xã Xuân Quan,Xã Cửu Cao,Xã Phụng Công,Xã Nghĩa Trụ,Xã Long Hưng,Xã Vĩnh Khúc,Xã Liên Nghĩa,Xã Tân Tiến,Xã Thắng Lợi,Xã Mễ Sở',
            'Huyện Yên Mỹ' => 'Thị trấn Yên Mỹ,Xã Giai Phạm,Xã Nghĩa Hiệp,Xã Đồng Than,Xã Ngọc Long,Xã Liêu Xá,Xã Hoàn Long,Xã Tân Lập,Xã Thanh Long,Xã Yên Phú,Xã Việt Cường,Xã Trung Hòa,Xã Yên Hòa,Xã Minh Châu,Xã Trung Hưng,Xã Lý Thường Kiệt,Xã Tân Việt',
            'Thị xã Mỹ Hào' => 'Phường Bần Yên Nhân,Phường Phan Đình Phùng,Xã Cẩm Xá,Xã Dương Quang,Xã Hòa Phong,Phường Nhân Hòa,Phường Dị Sử,Phường Bạch Sam,Phường Minh Đức,Phường Phùng Chí Kiên,Xã Xuân Dục,Xã Ngọc Lâm,Xã Hưng Long',
            'Huyện Ân Thi' => 'Thị trấn Ân Thi,Xã Phù Ủng,Xã Bắc Sơn,Xã Bãi Sậy,Xã Đào Dương,Xã Tân Phúc,Xã Vân Du,Xã Quang Vinh,Xã Xuân Trúc,Xã Hoàng Hoa Thám,Xã Quảng Lãng,Xã Văn Nhuệ,Xã Đặng Lễ,Xã Cẩm Ninh,Xã Nguyễn Trãi,Xã Đa Lộc,Xã Hồ Tùng Mậu,Xã Tiền Phong,Xã Hồng Vân,Xã Hồng Quang,Xã Hạ Lễ',
            'Huyện Khoái Châu' => 'Thị trấn Khoái Châu,Xã Đông Tảo,Xã Bình Minh,Xã Dạ Trạch,Xã Hàm Tử,Xã Ông Đình,Xã Tân Dân,Xã Tứ Dân,Xã An Vĩ,Xã Đông Kết,Xã Bình Kiều,Xã Dân Tiến,Xã Đồng Tiến,Xã Hồng Tiến,Xã Tân Châu,Xã Liên Khê,Xã Phùng Hưng,Xã Việt Hòa,Xã Đông Ninh,Xã Đại Tập,Xã Chí Tân,Xã Đại Hưng,Xã Thuần Hưng,Xã Thành Công,Xã Nhuế Dương',
            'Huyện Kim Động' => 'Thị trấn Lương Bằng,Xã Nghĩa Dân,Xã Toàn Thắng,Xã Vĩnh Xá,Xã Phạm Ngũ Lão,Xã Thọ Vinh,Xã Đồng Thanh,Xã Song Mai,Xã Chính Nghĩa,Xã Nhân La,Xã Phú Thịnh,Xã Mai Động,Xã Đức Hợp,Xã Hùng An,Xã Ngọc Thanh,Xã Vũ Xá,Xã Hiệp Cường',
            'Huyện Tiên Lữ' => 'Thị trấn Vương,Xã Hưng Đạo,Xã Ngô Quyền,Xã Nhật Tân,Xã Dị Chế,Xã Lệ Xá,Xã An Viên,Xã Đức Thắng,Xã Trung Dũng,Xã Hải Triều,Xã Thủ Sỹ,Xã Thiện Phiến,Xã Thụy Lôi,Xã Cương Chính,Xã Minh Phượng',
            'Huyện Phù Cừ' => 'Thị trấn Trần Cao,Xã Minh Tân,Xã Phan Sào Nam,Xã Quang Hưng,Xã Minh Hoàng,Xã Đoàn Đào,Xã Tống Phan,Xã Đình Cao,Xã Nhật Quang,Xã Tiền Tiến,Xã Tam Đa,Xã Minh Tiến,Xã Nguyên Hòa,Xã Tống Trân',
        ],
        'Tỉnh Thái Bình' => [
            'Thành phố Thái Bình' => 'Phường Lê Hồng Phong,Phường Bồ Xuyên,Phường Đề Thám,Phường Kỳ Bá,Phường Quang Trung,Phường Phú Khánh,Phường Tiền Phong,Phường Trần Hưng Đạo,Phường Trần Lãm,Xã Đông Hòa,Phường Hoàng Diệu,Xã Phú Xuân,Xã Vũ Phúc,Xã Vũ Chính,Xã Đông Mỹ,Xã Đông Thọ,Xã Vũ Đông,Xã Vũ Lạc,Xã Tân Bình',
            'Huyện Quỳnh Phụ' => 'Thị trấn Quỳnh Côi,Xã An Khê,Xã An Đồng,Xã Quỳnh Hoa,Xã Quỳnh Lâm,Xã Quỳnh Thọ,Xã An Hiệp,Xã Quỳnh Hoàng,Xã Quỳnh Giao,Xã An Thái,Xã An Cầu,Xã Quỳnh Hồng,Xã Quỳnh Khê,Xã Quỳnh Minh,Xã An Ninh,Xã Quỳnh Ngọc,Xã Quỳnh Hải,Thị trấn An Bài,Xã An Ấp,Xã Quỳnh Hội,Xã Châu Sơn,Xã Quỳnh Mỹ,Xã An Quí,Xã An Thanh,Xã An Vũ,Xã An Lễ,Xã Quỳnh Hưng,Xã Quỳnh Bảo,Xã An Mỹ,Xã Quỳnh Nguyên,Xã An Vinh,Xã Quỳnh Xá,Xã An Dục,Xã Đông Hải,Xã Quỳnh Trang,Xã An Tràng,Xã Đồng Tiến',
            'Huyện Hưng Hà' => 'Thị trấn Hưng Hà,Xã Điệp Nông,Xã Tân Lễ,Xã Cộng Hòa,Xã Dân Chủ,Xã Canh Tân,Xã Hòa Tiến,Xã Hùng Dũng,Xã Tân Tiến,Thị trấn Hưng Nhân,Xã Đoan Hùng,Xã Duyên Hải,Xã Tân Hòa,Xã Văn Cẩm,Xã Bắc Sơn,Xã Đông Đô,Xã Phúc Khánh,Xã Liên Hiệp,Xã Tây Đô,Xã Thống Nhất,Xã Tiến Đức,Xã Thái Hưng,Xã Thái Phương,Xã Hòa Bình,Xã Chi Lăng,Xã Minh Khai,Xã Hồng An,Xã Kim Chung,Xã Hồng Lĩnh,Xã Minh Tân,Xã Văn Lang,Xã Độc Lập,Xã Chí Hòa,Xã Minh Hòa,Xã Hồng Minh',
            'Huyện Đông Hưng' => 'Thị trấn Đông Hưng,Xã Đô Lương,Xã Đông Phương,Xã Liên Giang,Xã An Châu,Xã Đông Sơn,Xã Đông Cường,Xã Phú Lương,Xã Mê Linh,Xã Lô Giang,Xã Đông La,Xã Minh Tân,Xã Đông Xá,Xã Chương Dương,Xã Nguyên Xá,Xã Phong Châu,Xã Hợp Tiến,Xã Hồng Việt,Xã Hà Giang,Xã Đông Kinh,Xã Đông Hợp,Xã Thăng Long,Xã Đông Các,Xã Phú Châu,Xã Liên Hoa,Xã Đông Tân,Xã Đông Vinh,Xã Đông Động,Xã Hồng Bạch,Xã Trọng Quan,Xã Hồng Giang,Xã Đông Quan,Xã Đông Quang,Xã Đông Xuân,Xã Đông Á,Xã Đông Hoàng,Xã Đông Dương,Xã Minh Phú',
            'Huyện Thái Thụy' => 'Thị trấn Diêm Điền,Xã Thụy Trường,Xã Hồng Dũng,Xã Thụy Quỳnh,Xã An Tân,Xã Thụy Ninh,Xã Thụy Hưng,Xã Thụy Việt,Xã Thụy Văn,Xã Thụy Xuân,Xã Dương Phúc,Xã Thụy Trình,Xã Thụy Bình,Xã Thụy Chính,Xã Thụy Dân,Xã Thụy Hải,Xã Thụy Liên,Xã Thụy Duyên,Xã Thụy Thanh,Xã Thụy Sơn,Xã Thụy Phong,Xã Thái Thượng,Xã Thái Nguyên,Xã Dương Hồng  Thủy,Xã Thái Giang,Xã Hòa An,Xã Sơn Hà,Xã Thái Phúc,Xã Thái Hưng,Xã Thái Đô,Xã Thái Xuyên,Xã  Mỹ Lộc,Xã Tân Học,Xã Thái Thịnh,Xã Thuần Thành,Xã Thái Thọ',
            'Huyện Tiền Hải' => 'Thị trấn Tiền Hải,Xã Đông Trà,Xã Đông Long,Xã Đông Quí,Xã Vũ Lăng,Xã Đông Xuyên,Xã Tây Lương,Xã Tây Ninh,Xã Đông Trung,Xã Đông Hoàng,Xã Đông Minh,Xã Đông Phong,Xã An Ninh,Xã Đông Cơ,Xã Tây Giang,Xã Đông Lâm,Xã Phương Công,Xã Tây Phong,Xã Tây Tiến,Xã Nam Cường,Xã Vân Trường,Xã Nam Thắng,Xã Nam Chính,Xã Bắc Hải,Xã Nam Thịnh,Xã Nam Hà,Xã Nam Thanh,Xã Nam Trung,Xã Nam Hồng,Xã Nam Hưng,Xã Nam Hải,Xã Nam Phú',
            'Huyện Kiến Xương' => 'Thị trấn Kiến Xương,Xã Trà Giang,Xã Quốc Tuấn,Xã An Bình,Xã Tây Sơn,Xã Hồng Thái,Xã Bình Nguyên,Xã Lê Lợi,Xã Vũ Lễ,Xã Thanh Tân,Xã Thượng Hiền,Xã Nam Cao,Xã Đình Phùng,Xã Vũ Ninh,Xã Vũ An,Xã Quang Lịch,Xã Hòa Bình,Xã Bình Minh,Xã Vũ Quí,Xã Quang Bình,Xã Vũ Trung,Xã Vũ Thắng,Xã Vũ Công,Xã Vũ Hòa,Xã Quang Minh,Xã Quang Trung,Xã Minh Quang,Xã Vũ Bình,Xã Minh Tân,Xã Nam Bình,Xã Bình Thanh,Xã Bình Định,Xã Hồng Tiến',
            'Huyện Vũ Thư' => 'Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư,Huyện Vũ Thư',
        ],
        'Tỉnh Hà Nam' => [
            'Thành phố Phủ Lý' => 'Phường Quang Trung,Phường Lương Khánh Thiện,Phường Lê Hồng Phong,Phường Minh Khai,Phường Hai Bà Trưng,Phường Trần Hưng Đạo,Phường Lam Hạ,Xã Phù Vân,Phường Liêm Chính,Xã Liêm Chung,Phường Thanh Châu,Phường Châu Sơn,Xã Tiên Tân,Xã Tiên Hiệp,Xã Tiên Hải,Xã Kim Bình,Xã Liêm Tuyền,Xã Liêm Tiết,Phường Thanh Tuyền,Xã Đinh Xá,Xã Trịnh Xá',
            'Thị xã Duy Tiên' => 'Phường Đồng Văn,Phường Hòa Mạc,Xã Mộc Bắc,Phường Châu Giang,Phường Bạch Thượng,Phường Duy Minh,Xã Mộc Nam,Phường Duy Hải,Xã Chuyên Ngoại,Phường Yên Bắc,Xã Trác Văn,Phường Tiên Nội,Phường Hoàng Đông,Xã Yên Nam,Xã Tiên Ngoại,Xã Tiên Sơn',
            'Huyện Kim Bảng' => 'Thị trấn Quế,Xã Nguyễn Úy,Xã Đại Cương,Xã Lê Hồ,Xã Tượng Lĩnh,Xã Nhật Tựu,Xã Nhật Tân,Xã Đồng Hóa,Xã Hoàng Tây,Xã Tân Sơn,Xã Thụy Lôi,Xã Văn Xá,Xã Khả Phong,Xã Ngọc Sơn,Thị trấn Ba Sao,Xã Liên Sơn,Xã Thi Sơn,Xã Thanh Sơn',
            'Huyện Thanh Liêm' => 'Thị trấn Kiện Khê,Xã Liêm Phong,Xã Thanh Hà,Xã Liêm Cần,Xã Liêm Thuận,Xã Thanh Thủy,Xã Thanh Phong,Thị trấn Tân Thanh,Xã Thanh Tân,Xã Liêm Túc,Xã Liêm Sơn,Xã Thanh Hương,Xã Thanh Nghị,Xã Thanh Tâm,Xã Thanh Nguyên,Xã Thanh Hải',
            'Huyện Bình Lục' => 'Thị trấn Bình Mỹ,Xã Bình Nghĩa,Xã Tràng An,Xã Đồng Du,Xã Ngọc Lũ,Xã Hưng Công,Xã Đồn Xá,Xã An Ninh,Xã Bồ Đề,Xã Bối Cầu,Xã An Nội,Xã Vũ Bản,Xã Trung Lương,Xã An Đổ,Xã La Sơn,Xã Tiêu Động,Xã An Lão,',
            'Huyện Lý Nhân' => 'Xã Hợp Lý,Xã Nguyên Lý,Xã Chính Lý,Xã Chân Lý,Xã Đạo Lý,Xã Công Lý,Xã Văn Lý,Xã Bắc Lý,Xã Đức Lý,Xã Trần Hưng Đạo,Thị trấn Vĩnh Trụ,Xã Nhân Thịnh,Xã Nhân Khang,Xã Nhân Mỹ,Xã Nhân Nghĩa,Xã Nhân Chính,Xã Nhân Bình,Xã Phú Phúc,Xã Xuân Khê,Xã Tiến Thắng,Xã Hòa Hậu',
        ],
        'Tỉnh Nam Định' => [
            'Thành phố Nam Định' => 'Phường Hạ Long,Phường Trần Tế Xương,Phường Vị Hoàng,Phường Vị Xuyên,Phường Quang Trung,Phường Cửa Bắc,Phường Nguyễn Du,Phường Bà Triệu,Phường Trường Thi,Phường Phan Đình Phùng,Phường Ngô Quyền,Phường Trần Hưng Đạo,Phường Trần Đăng Ninh,Phường Năng Tĩnh,Phường Văn Miếu,Phường Trần Quang Khải,Phường Thống Nhất,Phường Lộc Hạ,Phường Lộc Vượng,Phường Cửa Nam,Phường Lộc Hòa,Xã Nam Phong,Phường Mỹ Xá,Xã Lộc An,Xã Nam Vân',
            'Huyện Mỹ Lộc' => 'Thị trấn Mỹ Lộc,Xã Mỹ Hà,Xã Mỹ Tiến,Xã Mỹ Thắng,Xã Mỹ Trung,Xã Mỹ Tân,Xã Mỹ Phúc,Xã Mỹ Hưng,Xã Mỹ Thuận,Xã Mỹ Thịnh,Xã Mỹ Thành',
            'Huyện Vụ Bản' => 'Thị trấn Gôi,Xã Minh Thuận,Xã Hiển Khánh,Xã Tân Khánh,Xã Hợp Hưng,Xã Đại An,Xã Tân Thành,Xã Cộng Hòa,Xã Trung Thành,Xã Quang Trung,Xã Minh Tân,Xã Liên Bảo,Xã Thành Lợi,Xã Kim Thái,Xã Liên Minh,Xã Đại Thắng,Xã Tam Thanh,Xã Vĩnh Hào',
            'Huyện Ý Yên' => 'Thị trấn Lâm,Xã Yên Trung,Xã Yên Thành,Xã Yên Tân,Xã Yên Lợi,Xã Yên Thọ,Xã Yên Nghĩa,Xã Yên Minh,Xã Yên Phương,Xã Yên Chính,Xã Yên Bình,Xã Yên Phú,Xã Yên Mỹ,Xã Yên Dương,Xã Yên Hưng,Xã Yên Khánh,Xã Yên Phong,Xã Yên Ninh,Xã Yên Lương,Xã Yên Hồng,Xã Yên Quang,Xã Yên Tiến,Xã Yên Thắng,Xã Yên Phúc,Xã Yên Cường,Xã Yên Lộc,Xã Yên Bằng,Xã Yên Đồng,Xã Yên Khang,Xã Yên Nhân,Xã Yên Trị',
            'Huyện Nghĩa Hưng' => 'Thị trấn Liễu Đề,Thị trấn Rạng Đông,Xã Nghĩa Đồng,Xã Nghĩa Thịnh,Xã Nghĩa Minh,Xã Nghĩa Thái,Xã Hoàng Nam,Xã Nghĩa Châu,Xã Nghĩa Trung,Xã Nghĩa Sơn,Xã Nghĩa Lạc,Xã Nghĩa Hồng,Xã Nghĩa Phong,Xã Nghĩa Phú,Xã Nghĩa Bình,Thị trấn Quỹ Nhất,Xã Nghĩa Tân,Xã Nghĩa Hùng,Xã Nghĩa Lâm,Xã Nghĩa Thành,Xã Phúc Thắng,Xã Nghĩa Lợi,Xã Nghĩa Hải,Xã Nam Điền',
            'Huyện Nam Trực' => 'Thị trấn Nam Giang,Xã Nam Mỹ,Xã Điền Xá,Xã Nghĩa An,Xã Nam Thắng,Xã Nam Toàn,Xã Hồng Quang,Xã Tân Thịnh,Xã Nam Cường,Xã Nam Hồng,Xã Nam Hùng,Xã Nam Hoa,Xã Nam Dương,Xã Nam Thanh,Xã Nam Lợi,Xã Bình Minh,Xã Đồng Sơn,Xã Nam Tiến,Xã Nam Hải,Xã Nam Thái',
            'Huyện Trực Ninh' => 'Thị trấn Cổ Lễ,Xã Phương Định,Xã Trực Chính,Xã Trung Đông,Xã Liêm Hải,Xã Trực Tuấn,Xã Việt Hùng,Xã Trực Đạo,Xã Trực Hưng,Xã Trực Nội,Thị trấn Cát Thành,Xã Trực Thanh,Xã Trực Khang,Xã Trực Thuận,Xã Trực Mỹ,Xã Trực Đại,Xã Trực Cường,Thị trấn Ninh Cường,Xã Trực Thái,Xã Trực Hùng,Xã Trực Thắng',
            'Huyện Xuân Trường' => 'Thị trấn Xuân Trường,Xã Xuân Châu,Xã Xuân Hồng,Xã Xuân Thành,Xã Xuân Thượng,Xã Xuân Phong,Xã Xuân Đài,Xã Xuân Tân,Xã Xuân Thủy,Xã Xuân Ngọc,Xã Xuân Bắc,Xã Xuân Phương,Xã Thọ Nghiệp,Xã Xuân Phú,Xã Xuân Trung,Xã Xuân Vinh,Xã Xuân Kiên,Xã Xuân Tiến,Xã Xuân Ninh,Xã Xuân Hòa',
            'Huyện Giao Thủy' => 'Thị trấn Ngô Đồng,Thị trấn Quất Lâm,Xã Giao Hương,Xã Hồng Thuận,Xã Giao Thiện,Xã Giao Thanh,Xã Hoành Sơn,Xã Bình Hòa,Xã Giao Tiến,Xã Giao Hà,Xã Giao Nhân,Xã Giao An,Xã Giao Lạc,Xã Giao Châu,Xã Giao Tân,Xã Giao Yến,Xã Giao Xuân,Xã Giao Thịnh,Xã Giao Hải,Xã Bạch Long,Xã Giao Long,Xã Giao Phong',
            'Huyện Hải Hậu' => 'Thị trấn Yên Định,Thị trấn Cồn,Thị trấn Thịnh Long,Xã Hải Nam,Xã Hải Trung,Xã Hải Vân,Xã Hải Minh,Xã Hải Anh,Xã Hải Hưng,Xã Hải Bắc,Xã Hải Phúc,Xã Hải Thanh,Xã Hải Hà,Xã Hải Long,Xã Hải Phương,Xã Hải Đường,Xã Hải Lộc,Xã Hải Quang,Xã Hải Đông,Xã Hải Sơn,Xã Hải Tân,Xã Hải Phong,Xã Hải An,Xã Hải Tây,Xã Hải Lý,Xã Hải Phú,Xã Hải Giang,Xã Hải Cường,Xã Hải Ninh,Xã Hải Chính,Xã Hải Xuân,Xã Hải Châu,Xã Hải Triều,Xã Hải Hòa',
        ],
        'Tỉnh Ninh Bình' => [
            'Thành phố Ninh Bình' => 'Phường Đông Thành,Phường Tân Thành,Phường Thanh Bình,Phường Vân Giang,Phường Bích Đào,Phường Phúc Thành,Phường Nam Bình,Phường Nam Thành,Phường Ninh Khánh,Xã Ninh Nhất,Xã Ninh Tiến,Xã Ninh Phúc,Phường Ninh Sơn,Phường Ninh Phong',
            'Thành phố Tam Điệp' => 'Phường Bắc Sơn,Phường Trung Sơn,Phường Nam Sơn,Phường Tây Sơn,Xã Yên Sơn,Phường Yên Bình,Phường Tân Bình,Xã Quang Sơn,Xã Đông Sơn',
            'Huyện Nho Quan' => 'Thị trấn Nho Quan,Xã Xích Thổ,Xã Gia Lâm,Xã Gia Sơn,Xã Thạch Bình,Xã Gia Thủy,Xã Gia Tường,Xã Cúc Phương,Xã Phú Sơn,Xã Đức Long,Xã Lạc Vân,Xã Đồng Phong,Xã Yên Quang,Xã Lạng Phong,Xã Thượng Hòa,Xã Văn Phong,Xã Văn Phương,Xã Thanh Lạc,Xã Sơn Lai,Xã Sơn Thành,Xã Văn Phú,Xã Phú Lộc,Xã Kỳ Phú,Xã Quỳnh Lưu,Xã Sơn Hà,Xã Phú Long,Xã Quảng Lạc',
            'Huyện Gia Viễn' => 'Thị trấn Me,Xã Gia Hòa,Xã Gia Hưng,Xã Liên Sơn,Xã Gia Thanh,Xã Gia Vân,Xã Gia Phú,Xã Gia Xuân,Xã Gia Lập,Xã Gia Vượng,Xã Gia Trấn,Xã Gia Thịnh,Xã Gia Phương,Xã Gia Tân,Xã Gia Thắng,Xã Gia Trung,Xã Gia Minh,Xã Gia Lạc,Xã Gia Tiến,Xã Gia Sinh,Xã Gia Phong',
            'Huyện Hoa Lư' => 'Thị trấn Thiên Tôn,Xã Ninh Giang,Xã Trường Yên,Xã Ninh Khang,Xã Ninh Mỹ,Xã Ninh Hòa,Xã Ninh Xuân,Xã Ninh Hải,Xã Ninh Thắng,Xã Ninh Vân,Xã Ninh An',
            'Huyện Yên Khánh' => 'Thị trấn Yên Ninh,Xã Khánh Tiên,Xã Khánh Phú,Xã Khánh Hòa,Xã Khánh Lợi,Xã Khánh An,Xã Khánh Cường,Xã Khánh Cư,Xã Khánh Thiện,Xã Khánh Hải,Xã Khánh Trung,Xã Khánh Mậu,Xã Khánh Vân,Xã Khánh Hội,Xã Khánh Công,Xã Khánh Thành,Xã Khánh Nhạc,Xã Khánh Thủy,Xã Khánh Hồng',
            'Huyện Kim Sơn' => 'Thị trấn Phát Diệm,Thị trấn Bình Minh,Xã Hồi Ninh,Xã Xuân Chính,Xã Kim Định,Xã Ân Hòa,Xã Hùng Tiến,Xã Quang Thiện,Xã Như Hòa,Xã Chất Bình,Xã Đồng Hướng,Xã Kim Chính,Xã Thượng Kiệm,Xã Lưu Phương,Xã Tân Thành,Xã Yên Lộc,Xã Lai Thành,Xã Định Hóa,Xã Văn Hải,Xã Kim Tân,Xã Kim Mỹ,Xã Cồn Thoi,Xã Kim Hải,Xã Kim Trung,Xã Kim Đông',
            'Huyện Yên Mô' => 'Thị trấn Yên Thịnh,Xã Khánh Thượng,Xã Khánh Dương,Xã Mai Sơn,Xã Khánh Thịnh,Xã Yên Phong,Xã Yên Hòa,Xã Yên Thắng,Xã Yên Từ,Xã Yên Hưng,Xã Yên Thành,Xã Yên Nhân,Xã Yên Mỹ,Xã Yên Mạc,Xã Yên Đồng,Xã Yên Thái,Xã Yên Lâm',
        ],
        'Tỉnh Thanh Hóa' => [
            'Thành phố Thanh Hóa' => 'Phường Hàm Rồng,Phường Đông Thọ,Phường Nam Ngạn,Phường Trường Thi,Phường Điện Biên,Phường Phú Sơn,Phường Lam Sơn,Phường Ba Đình,Phường Ngọc Trạo,Phường Đông Vệ,Phường Đông Sơn,Phường Tân Sơn,Phường Đông Cương,Phường Đông Hương,Phường Đông Hải,Phường Quảng Hưng,Phường Quảng Thắng,Phường Quảng Thành,Xã Thiệu Vân,Phường Thiệu Khánh,Phường Thiệu Dương,Phường Tào Xuyên,Phường Long Anh,Xã Hoằng Quang,Xã Hoằng Đại,Phường Đông Lĩnh,Xã Đông Vinh,Phường Đông Tân,Phường An Hưng,Phường Quảng Thịnh,Phường Quảng Đông,Phường Quảng Cát,Phường Quảng Phú,Phường Quảng Tâm',
            'Thị xã Bỉm Sơn' => 'Phường Bắc Sơn,Phường Ba Đình,Phường Lam Sơn,Phường Ngọc Trạo,Phường Đông Sơn,Phường Phú Sơn,Xã Quang Trung',
            'Thành phố Sầm Sơn' => 'Phường Trung Sơn,Phường Bắc Sơn,Phường Trường Sơn,Phường Quảng Cư,Phường Quảng Tiến,Xã Quảng Minh,Xã Quảng Hùng,Phường Quảng Thọ,Phường Quảng Châu,Phường Quảng Vinh,Xã Quảng Đại',
            'Huyện Mường Lát' => 'Thị trấn Mường Lát,Xã Tam Chung,Xã Mường Lý,Xã Trung Lý,Xã Quang Chiểu,Xã Pù Nhi,Xã Nhi Sơn,Xã Mường Chanh',
            'Huyện Quan Hóa' => 'Thị trấn Hồi Xuân,Xã Thành Sơn,Xã Trung Sơn,Xã Phú Thanh,Xã Trung Thành,Xã Phú Lệ,Xã Phú Sơn,Xã Phú Xuân,Xã Hiền Chung,Xã Hiền Kiệt,Xã Nam Tiến,Xã Thiên Phủ,Xã Phú Nghiêm,Xã Nam Xuân,Xã Nam Động',
            'Huyện Bá Thước' => 'Thị trấn Cành Nàng,Xã Điền Thượng,Xã Điền Hạ,Xã Điền Quang,Xã Điền Trung,Xã Thành Sơn,Xã Lương Ngoại,Xã Ái Thượng,Xã Lương Nội,Xã Điền Lư,Xã Lương Trung,Xã Lũng Niêm,Xã Lũng Cao,Xã Hạ Trung,Xã Cổ Lũng,Xã Thành Lâm,Xã Ban Công,Xã Kỳ Tân,Xã Văn Nho,Xã Thiết Ống,Xã Thiết Kế',
            'Huyện Quan Sơn' => 'Xã Trung Xuân,Xã Trung Thượng,Xã Trung Tiến,Xã Trung Hạ,Xã Sơn Hà,Xã Tam Thanh,Xã Sơn Thủy,Xã Na Mèo,Thị trấn Sơn Lư,Xã Tam Lư,Xã Sơn Điện,Xã Mường Mìn',
            'Huyện Lang Chánh' => 'Xã Yên Khương,Xã Yên Thắng,Xã Trí Nang,Xã Giao An,Xã Giao Thiện,Xã Tân Phúc,Xã Tam Văn,Xã Lâm Phú,Thị trấn Lang Chánh,Xã Đồng Lương',
            'Huyện Ngọc Lặc' => 'Thị Trấn Ngọc Lặc,Xã Lam Sơn,Xã Mỹ Tân,Xã Thúy Sơn,Xã Thạch Lập,Xã Vân Âm,Xã Cao Ngọc,Xã Quang Trung,Xã Đồng Thịnh,Xã Ngọc Liên,Xã Ngọc Sơn,Xã Lộc Thịnh,Xã Cao Thịnh,Xã Ngọc Trung,Xã Phùng Giáo,Xã Phùng Minh,Xã Phúc Thịnh,Xã Nguyệt Ấn,Xã Kiên Thọ,Xã Minh Tiến,Xã Minh Sơn',
            'Huyện Cẩm Thủy' => 'Thị trấn Phong Sơn,Xã Cẩm Thành,Xã Cẩm Quý,Xã Cẩm Lương,Xã Cẩm Thạch,Xã Cẩm Liên,Xã Cẩm Giang,Xã Cẩm Bình,Xã Cẩm Tú,Xã Cẩm Châu,Xã Cẩm Tâm,Xã Cẩm Ngọc,Xã Cẩm Long,Xã Cẩm Yên,Xã Cẩm Tân,Xã Cẩm Phú,Xã Cẩm Vân',
            'Huyện Thạch Thành' => 'Thị trấn Kim Tân,Thị trấn Vân Du,Xã Thạch Lâm,Xã Thạch Quảng,Xã Thạch Tượng,Xã Thạch Cẩm,Xã Thạch Sơn,Xã Thạch Bình,Xã Thạch Định,Xã Thạch Đồng,Xã Thạch Long,Xã Thành Mỹ,Xã Thành Yên,Xã Thành Vinh,Xã Thành Minh,Xã Thành Công,Xã Thành Tân,Xã Thành Trực,Xã Thành Tâm,Xã Thành An,Xã Thành Thọ,Xã Thành Tiến,Xã Thành Long,Xã Thành Hưng,Xã Ngọc Trạo',
            'Huyện Hà Trung' => 'Thị trấn Hà Trung,Xã Hà Long,Xã Hà Vinh,Xã Hà Bắc,Xã Hoạt Giang,Xã Yên Dương,Xã Hà Giang,Xã Lĩnh Toại,Xã Hà Ngọc,Xã Yến Sơn,Xã Hà Sơn,Xã Hà Lĩnh,Xã Hà Đông,Xã Hà Tân,Xã Hà Tiến,Xã Hà Bình,Xã Hà Lai,Xã Hà Châu,Xã Hà Thái,Xã Hà Hải',
            'Huyện Vĩnh Lộc' => 'Thị trấn Vĩnh Lộc,Xã Vĩnh Quang,Xã Vĩnh Yên,Xã Vĩnh Tiến,Xã Vĩnh Long,Xã Vĩnh Phúc,Xã Vĩnh Hưng,Xã Vĩnh Hòa,Xã Vĩnh Hùng,Xã Minh Tân,Xã Ninh Khang,Xã Vĩnh Thịnh,Xã Vĩnh An',
            'Huyện Yên Định' => 'Thị trấn Thống Nhất,Thị trấn Yên Lâm,Xã Yên Tâm,Xã Yên Phú,Thị trấn Quý Lộc,Xã Yên Thọ,Xã Yên Trung,Xã Yên Trường,Xã Yên Phong,Xã Yên Thái,Xã Yên Hùng,Xã Yên Thịnh,Xã Yên Ninh,Xã Yên Lạc,Xã Định Tăng,Xã Định Hòa,Xã Định Thành,Xã Định Công,Xã Định Tân,Xã Định Tiến,Xã Định Long,Xã Định Liên,Thị trấn Quán Lào,Xã Định Hưng,Xã Định Hải,Xã Định Bình',
            'Huyện Thọ Xuân' => 'Xã Xuân Hồng,Thị trấn Thọ Xuân,Xã Bắc Lương,Xã Nam Giang,Xã Xuân Phong,Xã Thọ Lộc,Xã Xuân Trường,Xã Xuân Hòa,Xã Thọ Hải,Xã Tây Hồ,Xã Xuân Giang,Xã Xuân Sinh,Xã Xuân Hưng,Xã Thọ Diên,Xã Thọ Lâm,Xã Thọ Xương,Xã Xuân Bái,Xã Xuân Phú,Thị trấn Sao Vàng,Thị trấn Lam Sơn,Xã Xuân Thiên,Xã Thuận Minh,Xã Thọ Lập,Xã Quảng Phú,Xã Xuân Tín,Xã Phú Xuân,Xã Xuân Lai,Xã Xuân Lập,Xã Xuân Minh,Xã Trường Xuân',
            'Huyện Thường Xuân' => 'Xã Bát Mọt,Xã Yên Nhân,Xã Xuân Lẹ,Xã Vạn Xuân,Xã Lương Sơn,Xã Xuân Cao,Xã Luận Thành,Xã Luận Khê,Xã Xuân Thắng,Xã Xuân Lộc,Thị trấn Thường Xuân,Xã Xuân Dương,Xã Thọ Thanh,Xã Ngọc Phụng,Xã Xuân Chinh,Xã Tân Thành',
            'Huyện Triệu Sơn' => 'Thị trấn Triệu Sơn,Xã Thọ Sơn,Xã Thọ Bình,Xã Thọ Tiến,Xã Hợp Lý,Xã Hợp Tiến,Xã Hợp Thành,Xã Triệu Thành,Xã Hợp Thắng,Xã Minh Sơn,Xã Dân Lực,Xã Dân Lý,Xã Dân Quyền,Xã An Nông,Xã Văn Sơn,Xã Thái Hòa,Thị trấn Nưa,Xã Đồng Lợi,Xã Đồng Tiến,Xã Đồng Thắng,Xã Tiến Nông,Xã Khuyến Nông,Xã Xuân Thịnh,Xã Xuân Lộc,Xã Thọ Dân,Xã Xuân Thọ,Xã Thọ Tân,Xã Thọ Ngọc,Xã Thọ Cường,Xã Thọ Phú,Xã Thọ Vực,Xã Thọ Thế,Xã Nông Trường,Xã Bình Sơn',
            'Huyện Thiệu Hóa' => 'Thị trấn Thiệu Hóa,Xã Thiệu Ngọc,Xã Thiệu Vũ,Xã Thiệu Phúc,Xã Thiệu Tiến,Xã Thiệu Công,Xã Thiệu Phú,Xã Thiệu Long,Xã Thiệu Giang,Xã Thiệu Duy,Xã Thiệu Nguyên,Xã Thiệu Hợp,Xã Thiệu Thịnh,Xã Thiệu Quang,Xã Thiệu Thành,Xã Thiệu Toán,Xã Thiệu Chính,Xã Thiệu Hòa,Xã Minh Tâm,Xã Thiệu Viên,Xã Thiệu Lý,Xã Thiệu Vận,Xã Thiệu Trung,Xã Tân Châu,Xã Thiệu Giao',
            'Huyện Hoằng Hóa' => 'Thị trấn Bút Sơn,Xã Hoằng Giang,Xã Hoằng Xuân,Xã Hoằng Phượng,Xã Hoằng Phú,Xã Hoằng Quỳ,Xã Hoằng Kim,Xã Hoằng Trung,Xã Hoằng Trinh,Xã Hoằng Sơn,Xã Hoằng Cát,Xã Hoằng Xuyên,Xã Hoằng Quý,Xã Hoằng Hợp,Xã Hoằng Đức,Xã Hoằng Hà,Xã Hoằng Đạt,Xã Hoằng Đạo,Xã Hoằng Thắng,Xã Hoằng Đồng,Xã Hoằng Thái,Xã Hoằng Thịnh,Xã Hoằng Thành,Xã Hoằng Lộc,Xã Hoằng Trạch,Xã Hoằng Phong,Xã Hoằng Lưu,Xã Hoằng Châu,Xã Hoằng Tân,Xã Hoằng Yến,Xã Hoằng Tiến,Xã Hoằng Hải,Xã Hoằng Ngọc,Xã Hoằng Đông,Xã Hoằng Thanh,Xã Hoằng Phụ,Xã Hoằng Trường',
            'Huyện Hậu Lộc' => 'Thị trấn Hậu Lộc,Xã Đồng Lộc,Xã Đại Lộc,Xã Triệu Lộc,Xã Tiến Lộc,Xã Lộc Sơn,Xã Cầu Lộc,Xã Thành Lộc,Xã Tuy Lộc,Xã Phong Lộc,Xã Mỹ Lộc,Xã Thuần Lộc,Xã Xuân Lộc,Xã Hoa Lộc,Xã Liên Lộc,Xã Quang Lộc,Xã Phú Lộc,Xã Hòa Lộc,Xã Minh Lộc,Xã Hưng Lộc,Xã Hải Lộc,Xã Đa Lộc,Xã Ngư Lộc',
            'Huyện Nga Sơn' => 'Thị trấn Nga Sơn,Xã Ba Đình,Xã Nga Vịnh,Xã Nga Văn,Xã Nga Thiện,Xã Nga Tiến,Xã Nga Phượng,Xã Nga Trung,Xã Nga Bạch,Xã Nga Thanh,Xã Nga Yên,Xã Nga Giáp,Xã Nga Hải,Xã Nga Thành,Xã Nga An,Xã Nga Phú,Xã Nga Điền,Xã Nga Tân,Xã Nga Thủy,Xã Nga Liên,Xã Nga Thái,Xã Nga Thạch,Xã Nga Thắng,Xã Nga Trường',
            'Huyện Như Sơn' => 'Thị trấn Yên Cát,Xã Bãi Trành,Xã Xuân Hòa,Xã Xuân Bình,Xã Hóa Quỳ,Xã Cát Vân,Xã Cát Tân,Xã Tân Bình,Xã Bình Lương,Xã Thanh Quân,Xã Thanh Xuân,Xã Thanh Hòa,Xã Thanh Phong,Xã Thanh Lâm,Xã Thanh Sơn,Xã Thượng Ninh',
            'Huyện Như Thanh' => 'Thị trấn Bến Sung,Xã Cán Khê,Xã Xuân Du,Xã Phượng Nghi,Xã Mậu Lâm,Xã Xuân Khang,Xã Phú Nhuận,Xã Hải Long,Xã Xuân Thái,Xã Xuân Phúc,Xã Yên Thọ,Xã Yên Lạc,Xã Thanh Tân,Xã Thanh Kỳ',
            'Huyện Nông Cống' => 'Thị trấn Nông Cống,Xã Tân Phúc,Xã Tân Thọ,Xã Hoàng Sơn,Xã Tân Khang,Xã Hoàng Giang,Xã Trung Chính,Xã Trung Thành,Xã Tế Thắng,Xã Tế Lợi,Xã Tế Nông,Xã Minh Nghĩa,Xã Minh Khôi,Xã Vạn Hòa,Xã Trường Trung,Xã Vạn Thắng,Xã Trường Giang,Xã Vạn Thiện,Xã Thăng Long,Xã Trường Minh,Xã Trường Sơn,Xã Thăng Bình,Xã Công Liêm,Xã Tượng Văn,Xã Thăng Thọ,Xã Tượng Lĩnh,Xã Tượng Sơn,Xã Công Chính,Xã Yên Mỹ',
            'Huyện Đông Sơn' => 'Thị trấn Rừng Thông,Xã Đông Hoàng,Xã Đông Ninh,Xã Đông Hòa,Xã Đông Yên,Xã Đông Minh,Xã Đông Thanh,Xã Đông Tiến,Xã Đông Khê,Xã Đông Thịnh,Xã Đông Văn,Xã Đông Phú,Xã Đông Nam,Xã Đông Quang',
            'Huyện Quảng Xương' => 'Thị trấn Tân Phong,Xã Quảng Trạch,Xã Quảng Đức,Xã Quảng Định,Xã Quảng Nhân,Xã Quảng Ninh,Xã Quảng Bình,Xã Quảng Hợp,Xã Quảng Văn,Xã Quảng Long,Xã Quảng Yên,Xã Quảng Hòa,Xã Quảng Khê,Xã Quảng Trung,Xã Quảng Chính,Xã Quảng Ngọc,Xã Quảng Trường,Xã Quảng Phúc,Xã Quảng Giao,Xã Quảng Hải,Xã Quảng Lưu,Xã Quảng Lộc,Xã Tiên Trang,Xã Quảng Nham,Xã Quảng Thạch,Xã Quảng Thái',
            'Thị xã Nghi Sơn' => 'Phường Hải Hòa,Phường Hải Châu,Xã Thanh Thủy,Xã Thanh Sơn,Phường Hải Ninh,Xã Anh Sơn,Xã Ngọc Lĩnh,Phường Hải An,Xã Các Sơn,Phường Tân Dân,Phường Hải Lĩnh,Xã Định Hải,Xã Phú Sơn,Phường Ninh Hải,Phường Nguyên Bình,Xã Hải Nhân,Phường Bình Minh,Phường Hải Thanh,Xã Phú Lâm,Phường Xuân Lâm,Phường Trúc Lâm,Phường Hải Bình,Xã Tân Trường,Xã Tùng Lâm,Phường Tĩnh Hải,Phường Mai Lâm,Xã Trường Lâm,Xã Hải Yến,Phường Hải Thượng,Xã Nghi Sơn,Xã Hải Hà',
        ],
        'Tỉnh Nghệ An' => [
            'Thành phố Vinh' => 'Phường Đông Vĩnh,Phường Hà Huy Tập,Phường Lê Lợi,Phường Quán Bàu,Phường Hưng Bình,Phường Hưng Phúc,Phường Hưng Dũng,Phường Cửa Nam,Phường Quang Trung,Phường Đội Cung,Phường Lê Mao,Phường Trường Thi,Phường Bến Thủy,Phường Hồng Sơn,Phường Trung Đô,Xã Nghi Phú,Xã Hưng Đông,Xã Hưng Lộc,Xã Hưng Hòa,Phường Vinh Tân,Xã Nghi Liên,Xã Nghi Ân,Xã Nghi Kim,Xã Nghi Đức,Xã Hưng Chính',
            'Thị xã Cửa Lò' => 'Phường Nghi Thuỷ,Phường Nghi Tân,Phường Thu Thuỷ,Phường Nghi Hòa,Phường Nghi Hải,Phường Nghi Hương,Phường Nghi Thu',
            'Thị xã Thái Hòa' => 'Phường Hoà Hiếu,Phường Quang Phong,Phường Quang Tiến,Phường Long Sơn,Xã Nghĩa Tiến,Xã Nghĩa Mỹ,Xã Tây Hiếu,Xã Nghĩa Thuận,Xã Đông Hiếu',
            'Huyện Quế Phong' => 'Thị trấn Kim Sơn,Xã Thông Thụ,Xã Đồng Văn,Xã Hạnh Dịch,Xã Tiền Phong,Xã Nậm Giải,Xã Tri Lễ,Xã Châu Kim,Xã Mường Nọc,Xã Châu Thôn,Xã Nậm Nhoóng,Xã Quang Phong,Xã Căm Muộn',
            'Huyện Quỳ Châu' => 'Thị trấn Tân Lạc,Xã Châu Bính,Xã Châu Thuận,Xã Châu Hội,Xã Châu Nga,Xã Châu Tiến,Xã Châu Hạnh,Xã Châu Thắng,Xã Châu Phong,Xã Châu Bình,Xã Châu Hoàn,Xã Diên Lãm',
            'Huyện Kỳ Sơn' => 'Thị trấn Mường Xén,Xã Mỹ Lý,Xã Bắc Lý,Xã Keng Đu,Xã Đoọc Mạy,Xã Huồi Tụ,Xã Mường Lống,Xã Na Loi,Xã Nậm Cắn,Xã Bảo Nam,Xã Phà Đánh,Xã Bảo Thắng,Xã Hữu Lập,Xã Tà Cạ,Xã Chiêu Lưu,Xã Mường Típ,Xã Hữu Kiệm,Xã Tây Sơn,Xã Mường Ải,Xã Na Ngoi,Xã Nậm Càn',
            'Huyện Tương Dương' => 'Thị trấn Thạch Giám,Xã Mai Sơn,Xã Nhôn Mai,Xã Hữu Khuông,Xã Yên Tĩnh,Xã Nga My,Xã Xiêng My,Xã Lưỡng Minh,Xã Yên Hòa,Xã Yên Na,Xã Lưu Kiền,Xã Xá Lượng,Xã Tam Thái,Xã Tam Đình,Xã Yên Thắng,Xã Tam Quang,Xã Tam Hợp',
            'Huyện Nghĩa Đàn' => 'Thị trấn Nghĩa Đàn,Xã Nghĩa Mai,Xã Nghĩa Yên,Xã Nghĩa Lạc,Xã Nghĩa Lâm,Xã Nghĩa Sơn,Xã Nghĩa Lợi,Xã Nghĩa Bình,Xã Nghĩa Thọ,Xã Nghĩa Minh,Xã Nghĩa Phú,Xã Nghĩa Hưng,Xã Nghĩa Hồng,Xã Nghĩa Thịnh,Xã Nghĩa Trung,Xã Nghĩa Hội,Xã Nghĩa Thành,Xã Nghĩa Hiếu,Xã Nghĩa Đức,Xã Nghĩa An,Xã Nghĩa Long,Xã Nghĩa Lộc,Xã Nghĩa Khánh',
            'Huyện Quỳ Hợp' => 'Thị trấn Quỳ Hợp,Xã Yên Hợp,Xã Châu Tiến,Xã Châu Hồng,Xã Đồng Hợp,Xã Châu Thành,Xã Liên Hợp,Xã Châu Lộc,Xã Tam Hợp,Xã Châu Cường,Xã Châu Quang,Xã Thọ Hợp,Xã Minh Hợp,Xã Nghĩa Xuân,Xã Châu Thái,Xã Châu Đình,Xã Văn Lợi,Xã Nam Sơn,Xã Châu Lý,Xã Hạ Sơn,Xã Bắc Sơn',
            'Huyện Quỳnh Lưu' => 'Thị trấn Cầu Giát,Xã Quỳnh Thắng,Xã Quỳnh Tân,Xã Quỳnh Châu,Xã Tân Sơn,Xã Quỳnh Văn,Xã Ngọc Sơn,Xã Quỳnh Tam,Xã Quỳnh Hoa,Xã Quỳnh Thạch,Xã Quỳnh Bảng,Xã Quỳnh Mỹ,Xã Quỳnh Thanh,Xã Quỳnh Hậu,Xã Quỳnh Lâm,Xã Quỳnh Đôi,Xã Quỳnh Lương,Xã Quỳnh Hồng,Xã Quỳnh Yên,Xã Quỳnh Bá,Xã Quỳnh Minh,Xã Quỳnh Diễn,Xã Quỳnh Hưng,Xã Quỳnh Giang,Xã Quỳnh Ngọc,Xã Quỳnh Nghĩa,Xã An Hòa,Xã Tiến Thủy,Xã Sơn Hải,Xã Quỳnh Thọ,Xã Quỳnh Thuận,Xã Quỳnh Long,Xã Tân Thắng',
            'Huyện Con Cuông' => 'Thị trấn Con Cuông,Xã Bình Chuẩn,Xã Lạng Khê,Xã Cam Lâm,Xã Thạch Ngàn,Xã Đôn Phục,Xã Mậu Đức,Xã Châu Khê,Xã Chi Khê,Xã Bồng Khê,Xã Yên Khê,Xã Lục Dạ,Xã Môn Sơn',
            'Huyện Tân Kỳ' => 'Thị trấn Tân Kỳ,Xã Tân Hợp,Xã Tân Phú,Xã Tân Xuân,Xã Giai Xuân,Xã Nghĩa Bình,Xã Nghĩa Đồng,Xã Đồng Văn,Xã Nghĩa Thái,Xã Nghĩa Hợp,Xã Nghĩa Hoàn,Xã Nghĩa Phúc,Xã Tiên Kỳ,Xã Tân An,Xã Nghĩa Dũng,Xã Tân Long,Xã Kỳ Sơn,Xã Hương Sơn,Xã Kỳ Tân,Xã Phú Sơn,Xã Tân Hương,Xã Nghĩa Hành',
            'Huyện Anh Sơn' => 'Thị trấn Anh Sơn,Xã Thọ Sơn,Xã Thành Sơn,Xã Bình Sơn,Xã Tam Sơn,Xã Đỉnh Sơn,Xã Hùng Sơn,Xã Cẩm Sơn,Xã Đức Sơn,Xã Tường Sơn,Xã Hoa Sơn,Xã Tào Sơn,Xã Vĩnh Sơn,Xã Lạng Sơn,Xã Hội Sơn,Xã Thạch Sơn,Xã Phúc Sơn,Xã Long Sơn,Xã Khai Sơn,Xã Lĩnh Sơn,Xã Cao Sơn',
            'Huyện Diễn Châu' => 'Thị trấn Diễn Châu,Xã Diễn Lâm,Xã Diễn Đoài,Xã Diễn Trường,Xã Diễn Yên,Xã Diễn Hoàng,Xã Diễn Hùng,Xã Diễn Mỹ,Xã Diễn Hồng,Xã Diễn Phong,Xã Diễn Hải,Xã Diễn Tháp,Xã Diễn Liên,Xã Diễn Vạn,Xã Diễn Kim,Xã Diễn Kỷ,Xã Diễn Xuân,Xã Diễn Thái,Xã Diễn Đồng,Xã Diễn Bích,Xã Diễn Hạnh,Xã Diễn Ngọc,Xã Diễn Quảng,Xã Diễn Nguyên,Xã Diễn Hoa,Xã Diễn Thành,Xã Diễn Phúc,Xã Diễn Cát,Xã Diễn Thịnh,Xã Diễn Tân,Xã Minh Châu,Xã Diễn Thọ,Xã Diễn Lợi,Xã Diễn Lộc,Xã Diễn Trung,Xã Diễn An,Xã Diễn Phú',
            'Huyện Yên Thành' => 'Thị trấn Yên Thành,Xã Mã Thành,Xã Tiến Thành,Xã Lăng Thành,Xã Tân Thành,Xã Đức Thành,Xã Kim Thành,Xã Hậu Thành,Xã Hùng Thành,Xã Đô Thành,Xã Thọ Thành,Xã Quang Thành,Xã Tây Thành,Xã Phúc Thành,Xã Hồng Thành,Xã Đồng Thành,Xã Phú Thành,Xã Hoa Thành,Xã Tăng Thành,Xã Văn Thành,Xã Thịnh Thành,Xã Hợp Thành,Xã Xuân Thành,Xã Bắc Thành,Xã Nhân Thành,Xã Trung Thành,Xã Long Thành,Xã Minh Thành,Xã Nam Thành,Xã Vĩnh Thành,Xã Lý Thành,Xã Khánh Thành,Xã Viên Thành,Xã Đại Thành,Xã Liên Thành,Xã Bảo Thành,Xã Mỹ Thành,Xã Công Thành,Xã Sơn Thành',
            'Huyện Đô Lương' => 'Thị trấn Đô Lương,Xã Giang Sơn Đông,Xã Giang Sơn Tây,Xã Lam Sơn,Xã Bồi Sơn,Xã Hồng Sơn,Xã Bài Sơn,Xã Ngọc Sơn,Xã Bắc Sơn,Xã Tràng Sơn,Xã Thượng Sơn,Xã Hòa Sơn,Xã Đặng Sơn,Xã Đông Sơn,Xã Nam Sơn,Xã Lưu Sơn,Xã Yên Sơn,Xã Văn Sơn,Xã Đà Sơn,Xã Lạc Sơn,Xã Tân Sơn,Xã Thái Sơn,Xã Quang Sơn,Xã Thịnh Sơn,Xã Trung Sơn,Xã Xuân Sơn,Xã Minh Sơn,Xã Thuận Sơn,Xã Nhân Sơn,Xã Hiến Sơn,Xã Mỹ Sơn,Xã Trù Sơn,Xã Đại Sơn',
            'Huyện Thanh Chương' => 'Thị trấn Thanh Chương,Xã Cát Văn,Xã Thanh Nho,Xã Hạnh Lâm,Xã Thanh Sơn,Xã Thanh Hòa,Xã Phong Thịnh,Xã Thanh Phong,Xã Thanh Mỹ,Xã Thanh Tiên,Xã Thanh Liên,Xã Đại Đồng,Xã Thanh Đồng,Xã Thanh Ngọc,Xã Thanh Hương,Xã Ngọc Lâm,Xã Thanh Lĩnh,Xã Đồng Văn,Xã Ngọc Sơn,Xã Thanh Thịnh,Xã Thanh An,Xã Thanh Chi,Xã Xuân Tường,Xã Thanh Dương,Xã Thanh Lương,Xã Thanh Khê,Xã Võ Liệt,Xã Thanh Long,Xã Thanh Thủy,Xã Thanh Khai,Xã Thanh Yên,Xã Thanh Hà,Xã Thanh Giang,Xã Thanh Tùng,Xã Thanh Lâm,Xã Thanh Mai,Xã Thanh Xuân,Xã Thanh Đức',
            'Huyện Nam Đàn' => 'Thị trấn Quán Hành,Xã Nghi Văn,Xã Nghi Yên,Xã Nghi Tiến,Xã Nghi Hưng,Xã Nghi Đồng,Xã Nghi Thiết,Xã Nghi Lâm,Xã Nghi Quang,Xã Nghi Kiều,Xã Nghi Mỹ,Xã Nghi Phương,Xã Nghi Thuận,Xã Nghi Long,Xã Nghi Xá,Xã Nghi Hoa,Xã Khánh Hợp,Xã Nghi Thịnh,Xã Nghi Công Bắc,Xã Nghi Công Nam,Xã Nghi Thạch,Xã Nghi Trung,Xã Nghi Trường,Xã Nghi Diên,Xã Nghi Phong,Xã Nghi Xuân,Xã Nghi Vạn,Xã Phúc Thọ,Xã Nghi Thái',
            'Huyện Hưng Nguyên' => 'Thị trấn Hưng Nguyên,Xã Hưng Trung,Xã Hưng Yên,Xã Hưng Yên Bắc,Xã Hưng Tây,Xã Hưng Đạo,Xã Hưng Mỹ,Xã Hưng Thịnh,Xã Hưng Lĩnh,Xã Hưng Thông,Xã Hưng Tân,Xã Hưng Lợi,Xã Hưng Nghĩa,Xã Hưng Phúc,Xã Long Xá,Xã Châu Nhân,Xã Xuân Lam,Xã Hưng Thành',
            'Thị xã Hoàng Mai' => 'Xã Quỳnh Vinh,Xã Quỳnh Lộc,Phường Quỳnh Thiện,Xã Quỳnh Lập,Xã Quỳnh Trang,Phường Mai Hùng,Phường Quỳnh Dị,Phường Quỳnh Xuân,Phường Quỳnh Phương,Xã Quỳnh Liên',
        ],
        'Tỉnh Nghệ Tĩnh' => [
            'Thành phố Hà Tĩnh' => 'Phường Trần Phú,Phường Nam Hà,Phường Bắc Hà,Phường Nguyễn Du,Phường Tân Giang,Phường Đại Nài,Phường Hà Huy Tập,Xã Thạch Trung,Phường Thạch Quý,Phường Thạch Linh,Phường Văn Yên,Xã Thạch Hạ,Xã Đồng Môn,Xã Thạch Hưng,Xã Thạch Bình',
            'Thị xã Hồng Lĩnh' => 'Phường Bắc Hồng,Phường Nam Hồng,Phường Trung Lương,Phường Đức Thuận,Phường Đậu Liêu,Xã Thuận Lộc',
            'Huyện Hương Sơn' => 'Thị trấn Phố Châu,Thị trấn  Tây Sơn,Xã Sơn Hồng,Xã Sơn Tiến,Xã Sơn Lâm,Xã Sơn Lễ,Xã Sơn Giang,Xã Sơn Lĩnh,Xã An Hòa Thịnh,Xã Sơn Tây,Xã Sơn Ninh,Xã Sơn Châu,Xã Tân Mỹ Hà,Xã Quang Diệm,Xã Sơn Trung,Xã Sơn Bằng,Xã Sơn Bình,Xã Sơn Kim 1,Xã Sơn Kim 2,Xã Sơn Trà,Xã Sơn Long,Xã Kim Hoa,Xã Sơn Hàm,Xã Sơn Phú,Xã Sơn Trường',
            'Huyện Đức Thọ' => 'Thị trấn Đức Thọ,Xã Quang Vĩnh,Xã Tùng Châu,Xã Trường Sơn,Xã Liên Minh,Xã Yên Hồ,Xã Tùng Ảnh,Xã Bùi La Nhân,Xã Thanh Bình Thịnh,Xã Lâm Trung Thủy,Xã Hòa Lạc,Xã Tân Dân,Xã An Dũng,Xã Đức Đồng,Xã Đức Lạng,Xã Tân Hương',
            'Huyện Vũ Quang' => 'Thị trấn Vũ Quang,Xã Ân Phú,Xã Đức Giang,Xã Đức Lĩnh,Xã Thọ Điền,Xã Đức Hương,Xã Đức Bồng,Xã Đức Liên,Xã Hương Minh,Xã Quang Thọ',
            'Huyện Nghi Xuân' => 'Thị trấn Xuân An,Xã Xuân Hội,Xã Đan Trường,Xã Xuân Phổ,Xã Xuân Hải,Xã Xuân Giang,Thị trấn Tiên Điền,Xã Xuân Yên,Xã Xuân Mỹ,Xã Xuân Thành,Xã Xuân Viên,Xã Xuân Hồng,Xã Cỗ Đạm,Xã Xuân Liên,Xã Xuân Lĩnh,Xã Xuân Lam,Xã Cương Gián',
            'Huyện Can Lộc' => 'Thị trấn Nghèn,Xã Thiên Lộc,Xã Thuần Thiện,Xã Vượng Lộc,Xã Thanh Lộc,Xã Kim Song Trường,Xã Thường Nga,Xã Tùng Lộc,Xã Phú Lộc,Xã Gia Hanh,Xã Khánh Vĩnh Yên,Xã Trung Lộc,Xã Xuân Lộc,Xã Thượng Lộc,Xã Quang Lộc,Thị trấn Đồng Lộc,Xã Mỹ Lộc,Xã Sơn Lộc',
            'Huyện Hương Khê' => 'Thị trấn Hương Khê,Xã Điền Mỹ,Xã Hà Linh,Xã Hương Thủy,Xã Hòa Hải,Xã Phúc Đồng,Xã Hương Giang,Xã Lộc Yên,Xã Hương Bình,Xã Hương Long,Xã Phú Gia,Xã Gia Phố,Xã Phú Phong,Xã Hương Đô,Xã Hương Vĩnh,Xã Hương Xuân,Xã Phúc Trạch,Xã Hương Trà,Xã Hương Trạch,Xã Hương Lâm,Xã Hương Liên',
            'Huyện Thạch Hà' => 'Thị trấn Thạch Hà,Xã Ngọc Sơn,Xã Thạch Hải,Xã Thạch Kênh,Xã Thạch Sơn,Xã Thạch Liên,Xã Đỉnh Bàn,Xã Việt Tiến,Xã Thạch Khê,Xã Thạch Long,Xã Thạch Trị,Xã Thạch Lạc,Xã Thạch Ngọc,Xã Tượng Sơn,Xã Thạch Văn,Xã Lưu Vĩnh Sơn,Xã Thạch Thắng,Xã Thạch Đài,Xã Thạch Hội,Xã Tân Lâm Hương,Xã Thạch Xuân,Xã Nam Điền',
            'Huyện Cẩm Xuyên' => 'Thị trấn Cẩm Xuyên,Thị trấn Thiên Cầm,Xã Yên Hòa,Xã Cẩm Dương,Xã Cẩm Bình,Xã Cẩm Vĩnh,Xã Cẩm Thành,Xã Cẩm Quang,Xã Cẩm Thạch,Xã Cẩm Nhượng,Xã Nam Phúc Thăng,Xã Cẩm Duệ,Xã Cẩm Lĩnh,Xã Cẩm Quan,Xã Cẩm Hà,Xã Cẩm Lộc,Xã Cẩm Hưng,Xã Cẩm Thịnh,Xã Cẩm Mỹ,Xã Cẩm Trung,Xã Cẩm Sơn,Xã Cẩm Lạc,Xã Cẩm Minh',
            'Huyện Kỳ Anh' => 'Xã Kỳ Xuân,Xã Kỳ Bắc,Xã Kỳ Phú,Xã Kỳ Phong,Xã Kỳ Tiến,Xã Kỳ Giang,Xã Kỳ Đồng,Xã Kỳ Khang,Xã Kỳ Văn,Xã Kỳ Trung,Xã Kỳ Thọ,Xã Kỳ Tây,Xã Kỳ Thượng,Xã Kỳ Hải,Xã Kỳ Thư,Xã Kỳ Châu,Xã Kỳ Tân,Xã Lâm Hợp,Xã Kỳ Sơn,Xã Kỳ Lạc',
            'Huyện Lộc hà' => 'Xã Tân Lộc,Xã Hồng Lộc,Xã Thịnh Lộc,Xã Bình An,Xã Ích Hậu,Xã Phù Lưu,Thị trấn Lộc Hà,Xã Thạch Mỹ,Xã Thạch Kim,Xã Thạch Châu,Xã Hộ Độ,Xã Mai Phụ',
            'Thị xã Kỳ Anh' => 'Phường Hưng Trí,Xã Kỳ Ninh,Xã Kỳ Lợi,Xã Kỳ Hà,Phường Kỳ Trinh,Phường Kỳ Thịnh,Xã Kỳ Hoa,Phường Kỳ Phương,Phường Kỳ Long,Phường Kỳ Liên,Xã Kỳ Nam',
        ],
        'Tỉnh Quảng Bình' => [
            'Thành phố Đồng Hới' => 'Phường Hải Thành,Phường Đồng Phú,Phường Bắc Lý,Phường Nam Lý,Phường Đồng Hải,Phường Đồng Sơn,Phường Phú Hải,Phường Bắc Nghĩa,Phường Đức Ninh Đông,Xã Quang Phú,Xã Lộc Ninh,Xã Bảo Ninh,Xã Nghĩa Ninh,Xã Thuận Đức,Xã Đức Ninh',
            'Huyện Minh Hóa' => 'Thị trấn Quy Đạt,Xã Dân Hóa,Xã Trọng Hóa,Xã Hóa Phúc,Xã Hồng Hóa,Xã Hóa Thanh,Xã Hóa Tiến,Xã Hóa Hợp,Xã Xuân Hóa,Xã Yên Hóa,Xã Minh Hóa,Xã Tân Hóa,Xã Hóa Sơn,Xã Trung Hóa,Xã Thượng Hóa',
            'Huyện Tuyên Hóa' => 'Thị trấn Đồng Lê,Xã Hương Hóa,Xã Kim Hóa,Xã Thanh Hóa,Xã Thanh Thạch,Xã Thuận Hóa,Xã Lâm Hóa,Xã Lê Hóa,Xã Sơn Hóa,Xã Đồng Hóa,Xã Ngư Hóa,Xã Thạch Hóa,Xã Đức Hóa,Xã Phong Hóa,Xã Mai Hóa,Xã Tiến Hóa,Xã Châu Hóa,Xã Cao Quảng,Xã Văn Hóa',
            'Huyện Quảng Trạch' => 'Xã Quảng Hợp,Xã Quảng Kim,Xã Quảng Đông,Xã Quảng Phú,Xã Quảng Châu,Xã Quảng Thạch,Xã Quảng Lưu,Xã Quảng Tùng,Xã Cảnh Dương,Xã Quảng Tiến,Xã Quảng Hưng,Xã Quảng Xuân,Xã Cảnh Hóa,Xã Liên Trường,Xã Quảng Phương,Xã Phù Hóa,Xã Quảng Thanh',
            'Huyện Bố Trạch' => 'Thị trấn Hoàn Lão,Thị trấn NT Việt Trung,Xã Xuân Trạch,Xã Mỹ Trạch,Xã Hạ Trạch,Xã Bắc Trạch,Xã Lâm Trạch,Xã Thanh Trạch,Xã Liên Trạch,Xã Phúc Trạch,Xã Cự Nẫm,Xã Hải Phú,Xã Thượng Trạch,Xã Sơn Lộc,Xã Hưng Trạch,Xã Đồng Trạch,Xã Đức Trạch,Thị trấn Phong Nha,Xã Vạn Trạch,Xã Phú Định,Xã Trung Trạch,Xã Tây Trạch,Xã Hòa Trạch,Xã Đại Trạch,Xã Nhân Trạch,Xã Tân Trạch,Xã Nam Trạch,Xã Lý Trạch',
            'Huyện Quảng Ninh' => 'Thị trấn Quán Hàu,Xã Trường Sơn,Xã Lương Ninh,Xã Vĩnh Ninh,Xã Võ Ninh,Xã Hải Ninh,Xã Hàm Ninh,Xã Duy Ninh,Xã Gia Ninh,Xã Trường Xuân,Xã Hiền Ninh,Xã Tân Ninh,Xã Xuân Ninh,Xã An Ninh,Xã Vạn Ninh',
            'Huyện Lệ Thủy' => 'Thị trấn NT Lệ Ninh,Thị trấn Kiến Giang,Xã Hồng Thủy,Xã Ngư Thủy Bắc,Xã Hoa Thủy,Xã Thanh Thủy,Xã An Thủy,Xã Phong Thủy,Xã Cam Thủy,Xã Ngân Thủy,Xã Sơn Thủy,Xã Lộc Thủy,Xã Liên Thủy,Xã Hưng Thủy,Xã Dương Thủy,Xã Tân Thủy,Xã Phú Thủy,Xã Xuân Thủy,Xã Mỹ Thủy,Xã Ngư Thủy ,Xã Mai Thủy,Xã Sen Thủy,Xã Thái Thủy,Xã Kim Thủy,Xã Trường Thủy,Xã Lâm Thủy',
            'Thị xã Ba Đồn' => 'Phường Ba Đồn,Phường Quảng Long,Phường Quảng Thọ,Xã Quảng Tiên,Xã Quảng Trung,Phường Quảng Phong,Phường Quảng Thuận,Xã Quảng Tân,Xã Quảng Hải,Xã Quảng Sơn,Xã Quảng Lộc,Xã Quảng Thủy,Xã Quảng Văn,Phường Quảng Phúc,Xã Quảng Hòa,Xã Quảng Minh',
        ],
        'Tỉnh Quảng Trị' => [
            'Thành phố Đông Hà' => 'Phường Đông Giang,Phường 1,Phường Đông Lễ,Phường Đông Thanh,Phường 2,Phường 4,Phường 5,Phường Đông Lương,Phường 3',
            'Thị xã Quảng trị' => 'Phường 1,Phường An Đôn,Phường 2,Phường 3,Xã Hải Lệ',
            'Huyện Vĩnh Linh' => 'Thị trấn Hồ Xá,Thị trấn Bến Quan,Xã Vĩnh Thái,Xã Vĩnh Tú,Xã Vĩnh Chấp,Xã Trung Nam,Xã Kim Thạch,Xã Vĩnh Long,Xã Vĩnh Khê,Xã Vĩnh Hòa,Xã Vĩnh Thủy,Xã Vĩnh Lâm,Xã Hiền Thành,Thị trấn Cửa Tùng,Xã Vĩnh Hà,Xã Vĩnh Sơn,Xã Vĩnh Giang,Xã Vĩnh Ô',
            'Huyện Hướng Hóa' => 'Thị trấn Khe Sanh,Thị trấn Lao Bảo,Xã Hướng Lập,Xã Hướng Việt,Xã Hướng Phùng,Xã Hướng Sơn,Xã Hướng Linh,Xã Tân Hợp,Xã Hướng Tân,Xã Tân Thành,Xã Tân Long,Xã Tân Lập,Xã Tân Liên,Xã Húc,Xã Thuận,Xã Hướng Lộc,Xã Ba Tầng,Xã Thanh,Xã  A Dơi,Xã Lìa,Xã Xy',
            'Huyện Gio Linh' => 'Thị trấn Gio Linh,Thị trấn Cửa Việt,Xã Trung Giang,Xã Trung Hải,Xã Trung Sơn,Xã Phong Bình,Xã Gio Mỹ,Xã Gio Hải,Xã Gio An,Xã Gio Châu,Xã Gio Việt,Xã Linh Trường,Xã Gio Sơn,Xã Gio Mai,Xã Hải Thái,Xã Linh Hải,Xã Gio Quang',
            'Huyện Đa Krông' => 'Thị trấn Krông Klang,Xã Mò Ó,Xã Hướng Hiệp,Xã Đa Krông,Xã Triệu Nguyên,Xã Ba Lòng,Xã Ba Nang,Xã Tà Long,Xã Húc Nghì,Xã A Vao,Xã Tà Rụt,Xã A Bung,Xã A Ngo',
            'Huyện Cam Lộ' => 'Thị trấn Cam Lộ,Xã Cam Tuyền,Xã Thanh An,Xã Cam Thủy,Xã Cam Thành,Xã Cam Hiếu,Xã Cam Chính,Xã Cam Nghĩa',
            'Huyện Triệu Phong' => 'Thị Trấn Ái Tử,Xã Triệu An,Xã Triệu Vân,Xã Triệu Phước,Xã Triệu Độ,Xã Triệu Trạch,Xã Triệu Thuận,Xã Triệu Đại,Xã Triệu Hòa,Xã Triệu Lăng,Xã Triệu Sơn,Xã Triệu Long,Xã Triệu Tài,Xã Triệu Trung,Xã Triệu Ái,Xã Triệu Thượng,Xã Triệu Giang,Xã Triệu Thành',
            'Huyện Hải Lăng' => 'Thị trấn Diên Sanh,Xã Hải An,Xã Hải Ba,Xã Hải Quy,Xã Hải Quế,Xã Hải Hưng,Xã Hải Phú,Xã Hải Thượng,Xã Hải Dương,Xã Hải Định,Xã Hải Lâm,Xã Hải Phong,Xã Hải Trường,Xã Hải Sơn,Xã Hải Chánh,Xã Hải Khê',
            'Huyện Cồn Cỏ' => null,
        ],
        'Tỉnh Thừa Thiên Huế' => [
            'Thành phố Huế' => 'Phường Tây Lộc,Phường Thuận Lộc,Phường Gia Hội,Phường Phú Hậu,Phường Thuận Hòa,Phường Đông Ba,Phường Kim Long,Phường Vỹ Dạ,Phường Phường Đúc,Phường Vĩnh Ninh,Phường Phú Hội,Phường Phú Nhuận,Phường Xuân Phú,Phường Trường An,Phường Phước Vĩnh,Phường An Cựu,Phường An Hòa,Phường Hương Sơ,Phường Thuỷ Biều,Phường Hương Long,Phường Thuỷ Xuân,Phường An Đông,Phường An Tây,Phường Thuận An,Xã Phú Dương,Xã Phú Mậu,Xã Phú Thanh,Phường Phú Thượng,Phường Thủy Vân,Xã Thủy Bằng,Xã Hải Dương,Xã Hương Phong,Phường Hương Vinh,Phường Hương An,Phường Hương Hồ,Xã Hương Thọ',
            'Huyện Phong Điền' => 'Thị trấn Phong Điền,Xã Điền Hương,Xã Điền Môn,Xã Điền Lộc,Xã Phong Bình,Xã Điền Hòa,Xã Phong Chương,Xã Phong Hải,Xã Điền Hải,Xã Phong Hòa,Xã Phong Thu,Xã Phong Hiền,Xã Phong Mỹ,Xã Phong An,Xã Phong Xuân,Xã Phong Sơn',
            'Huyện Quảng Điền' => 'Thị trấn Sịa,Xã Quảng Thái,Xã Quảng Ngạn,Xã Quảng Lợi,Xã Quảng Công,Xã Quảng Phước,Xã Quảng Vinh,Xã Quảng An,Xã Quảng Thành,Xã Quảng Thọ,Xã Quảng Phú',
            'Huyện Phú Vang' => 'Xã Phú Thuận,Xã Phú An,Xã Phú Hải,Xã Phú Xuân,Xã Phú Diên,Xã Phú Mỹ,Xã Phú Hồ,Xã Vinh Xuân,Xã Phú Lương,Thị trấn Phú Đa,Xã Vinh Thanh,Xã Vinh An,Xã Phú Gia,Xã Vinh Hà',
            'Thị xã Hương Thủy' => 'Phường Phú Bài,Xã Thủy Thanh,Phường Thủy Dương,Phường Thủy Phương,Phường Thủy Châu,Phường Thủy Lương,Xã Thủy Tân,Xã Thủy Phù,Xã Phú Sơn,Xã Dương Hòa',
            'Thị xã Hương Trà' => 'Phường Tứ Hạ,Xã Hương Toàn,Phường Hương Vân,Phường Hương Văn,Phường Hương Xuân,Phường Hương Chữ,Xã Hương Bình,Xã Bình Tiến,Xã Bình Thành',
            'Huyện A Lưới' => 'Thị trấn A Lưới,Xã Hồng Vân,Xã Hồng Hạ,Xã Hồng Kim,Xã Trung Sơn,Xã Hương Nguyên,Xã Hồng Bắc,Xã A Ngo,Xã Sơn Thủy,Xã Phú Vinh,Xã Hương Phong,Xã Quảng Nhâm,Xã Hồng Thượng,Xã Hồng Thái,Xã A Roàng,Xã Đông Sơn,Xã Lâm Đớt,Xã Hồng Thủy',
            'Huyện Phú Lộc' => 'Thị trấn Phú Lộc,Thị trấn Lăng Cô,Xã Vinh Mỹ,Xã Vinh Hưng,Xã Giang Hải,Xã Vinh Hiền,Xã Lộc Bổn,Xã Lộc Sơn,Xã Lộc Bình,Xã Lộc Vĩnh,Xã Lộc An,Xã Lộc Điền,Xã Lộc Thủy,Xã Lộc Trì,Xã Lộc Tiến,Xã Lộc Hòa,Xã Xuân Lộc',
            'Huyện Nam Đông' => 'Thị trấn Khe Tre,Xã Hương Phú,Xã Hương Sơn,Xã Hương Lộc,Xã Thượng Quảng,Xã Hương Xuân,Xã Hương Hữu,Xã Thượng Lộ,Xã Thượng Long,Xã Thượng Nhật',
        ],
        'Thành phố Đà Nẵng' => [
            'Quận Liên Chiểu' => 'Phường Hòa Hiệp Bắc,Phường Hòa Hiệp Nam,Phường Hòa Khánh Bắc,Phường Hòa Khánh Nam,Phường Hòa Minh',
            'Quận Thanh Khê' => 'Phường Tam Thuận,Phường Thanh Khê Tây,Phường Thanh Khê Đông,Phường Xuân Hà,Phường Tân Chính,Phường Chính Gián,Phường Vĩnh Trung,Phường Thạc Gián,Phường An Khê,Phường Hòa Khê',
            'Quận Hải Châu' => 'Phường Thanh Bình,Phường Thuận Phước,Phường Thạch Thang,Phường Hải Châu  I,Phường Hải Châu II,Phường Phước Ninh,Phường Hòa Thuận Tây,Phường Hòa Thuận Đông,Phường Nam Dương,Phường Bình Hiên,Phường Bình Thuận,Phường Hòa Cường Bắc,Phường Hòa Cường Nam',
            'Quận Sơn Trà' => 'Phường Thọ Quang,Phường Nại Hiên Đông,Phường Mân Thái,Phường An Hải Bắc,Phường Phước Mỹ,Phường An Hải Tây,Phường An Hải Đông',
            'Quận Ngũ Hành Sơn' => 'Phường Mỹ An,Phường Khuê Mỹ,Phường Hoà Quý,Phường Hoà Hải',
            'Quận Cẩm Lệ' => 'Phường Khuê Trung,Phường Hòa Phát,Phường Hòa An,Phường Hòa Thọ Tây,Phường Hòa Thọ Đông,Phường Hòa Xuân',
            'Huyện Hoàng Sa' => 'Xã Hòa Bắc,Xã Hòa Liên,Xã Hòa Ninh,Xã Hòa Sơn,Xã Hòa Nhơn,Xã Hòa Phú,Xã Hòa Phong,Xã Hòa Châu,Xã Hòa Tiến,Xã Hòa Phước,Xã Hòa Khương',
            'Huyện Hoàng Sa' => null,
        ],
        'Tỉnh Quảng Nam' => [
            'Thành phố Tam Kỳ' => 'Phường Tân Thạnh,Phường Phước Hòa,Phường An Mỹ,Phường Hòa Hương,Phường An Xuân,Phường An Sơn,Phường Trường Xuân,Phường An Phú,Xã Tam Thanh,Xã Tam Thăng,Xã Tam Phú,Phường Hoà Thuận,Xã Tam Ngọc',
            'Thành phố Hội An' => 'Phường Minh An,Phường Tân An,Phường Cẩm Phô,Phường Thanh Hà,Phường Sơn Phong,Phường Cẩm Châu,Phường Cửa Đại,Phường Cẩm An,Xã Cẩm Hà,Xã Cẩm Kim,Phường Cẩm Nam,Xã Cẩm Thanh,Xã Tân Hiệp',
            'Huyện Tây Giang' => "Xã Ch'ơm,Xã Ga Ri,Xã A Xan,Xã Tr'Hy,Xã Lăng,Xã A Nông,Xã A Tiêng,Xã Bha Lê,Xã A Vương,Xã Dang",
            'Huyện Đông Giang' => 'Thị trấn P Rao,Xã Tà Lu,Xã Sông Kôn,Xã Jơ Ngây,Xã A Ting,Xã  Tư,Xã Ba,Xã A Rooi,Xã Za Hung,Xã Mà Cooi,Xã Ka Dăng',
            'Huyện Đại Lộc' => 'Thị Trấn Ái Nghĩa,Xã Đại Sơn,Xã Đại Lãnh,Xã Đại Hưng,Xã Đại Hồng,Xã Đại Đồng,Xã Đại Quang,Xã Đại Nghĩa,Xã Đại Hiệp,Xã Đại Thạnh,Xã Đại Chánh,Xã Đại Tân,Xã Đại Phong,Xã Đại Minh,Xã Đại Thắng,Xã Đại Cường,Xã Đại An,Xã Đại Hòa',
            'Thị xã Điện Bàn' => 'Phường Vĩnh Điện,Xã Điện Tiến,Xã Điện Hòa,Xã Điện Thắng Bắc,Xã Điện Thắng Trung,Xã Điện Thắng Nam,Phường Điện Ngọc,Xã Điện Hồng,Xã Điện Thọ,Xã Điện Phước,Phường Điện An,Phường Điện Nam Bắc,Phường Điện Nam Trung,Phường Điện Nam Đông,Phường Điện Dương,Xã Điện Quang,Xã Điện Trung,Xã Điện Phong,Xã Điện Minh,Xã Điện Phương',
            'Huyện Duy Xuyên' => 'Thị trấn Nam Phước,Xã Duy Thu,Xã Duy Phú,Xã Duy Tân,Xã Duy Hòa,Xã Duy Châu,Xã Duy Trinh,Xã Duy Sơn,Xã Duy Trung,Xã Duy Phước,Xã Duy Thành,Xã Duy Vinh,Xã Duy Nghĩa,Xã Duy Hải',
            'Huyện Quế Sơn' => 'Thị trấn Đông Phú,Xã Quế Xuân 1,Xã Quế Xuân 2,Xã Quế Phú,Thị trấn Hương An,Xã Quế Hiệp,Xã Quế Thuận,Xã Quế Mỹ,Xã Quế Long,Xã Quế Châu,Xã Quế Phong,Xã Quế An,Xã Quế Minh',
            'Huyện Nam Giang' => 'Thị trấn Thạnh Mỹ,Xã Laêê,Xã Chơ Chun,Xã Zuôich,Xã Tà Pơơ,Xã La Dêê,Xã Đắc Tôi,Xã Chà Vàl,Xã Tà Bhinh,Xã Cà Dy,Xã Đắc Pre,Xã Đắc Pring',
            'Huyện Phước Sơn' => 'Thị trấn Khâm Đức,Xã Phước Xuân,Xã Phước Hiệp,Xã Phước Hoà,Xã Phước Đức,Xã Phước Năng,Xã Phước Mỹ,Xã Phước Chánh,Xã Phước Công,Xã Phước Kim,Xã Phước Lộc,Xã Phước Thành',
            'Huyện Hiệp Đức' => 'Xã Hiệp Hòa,Xã Hiệp Thuận,Xã Quế Thọ,Xã Bình Lâm,Xã Sông Trà,Xã Phước Trà,Xã Phước Gia,Thị trấn Tân Bình,Xã Quế Lưu,Xã Thăng Phước,Xã Bình Sơn',
            'Huyện Thăng Bình' => 'Thị trấn Hà Lam,Xã Bình Dương,Xã Bình Giang,Xã Bình Nguyên,Xã Bình Phục,Xã Bình Triều,Xã Bình Đào,Xã Bình Minh,Xã Bình Lãnh,Xã Bình Trị,Xã Bình Định Bắc,Xã Bình Định Nam,Xã Bình Quý,Xã Bình Phú,Xã Bình Chánh,Xã Bình Tú,Xã Bình Sa,Xã Bình Hải,Xã Bình Quế,Xã Bình An,Xã Bình Trung,Xã Bình Nam',
            'Huyện Tiên Phước' => 'Thị trấn Tiên Kỳ,Xã Tiên Sơn,Xã Tiên Hà,Xã Tiên Cẩm,Xã Tiên Châu,Xã Tiên Lãnh,Xã Tiên Ngọc,Xã Tiên Hiệp,Xã Tiên Cảnh,Xã Tiên Mỹ,Xã Tiên Phong,Xã Tiên Thọ,Xã Tiên An,Xã Tiên Lộc,Xã Tiên Lập',
            'Huyện Bắc Trà My' => 'Thị trấn Trà My,Xã Trà Sơn,Xã Trà Kót,Xã Trà Nú,Xã Trà Đông,Xã Trà Dương,Xã Trà Giang,Xã Trà Bui,Xã Trà Đốc,Xã Trà Tân,Xã Trà Giác,Xã Trà Giáp,Xã Trà Ka',
            'Huyện Nam Trà My' => 'Xã Trà Leng,Xã Trà Dơn,Xã Trà Tập,Xã Trà Mai,Xã Trà Cang,Xã Trà Linh,Xã Trà Nam,Xã Trà Don,Xã Trà Vân,Xã Trà Vinh',
            'Huyện Núi Thành' => 'Thị trấn Núi Thành,Xã Tam Xuân I,Xã Tam Xuân II,Xã Tam Tiến,Xã Tam Sơn,Xã Tam Thạnh,Xã Tam Anh Bắc,Xã Tam Anh Nam,Xã Tam Hòa,Xã Tam Hiệp,Xã Tam Hải,Xã Tam Giang,Xã Tam Quang,Xã Tam Nghĩa,Xã Tam Mỹ Tây,Xã Tam Mỹ Đông,Xã Tam Trà',
            'Huyện Phú Ninh' => 'Thị trấn Phú Thịnh,Xã Tam Thành,Xã Tam An,Xã Tam Đàn,Xã Tam Lộc,Xã Tam Phước,Xã Tam Vinh,Xã Tam Thái,Xã Tam Đại,Xã Tam Dân,Xã Tam Lãnh',
            'Huyện Nông Sơn' => 'Xã Quế Trung,Xã Ninh Phước,Xã Phước Ninh,Xã Quế Lộc,Xã Sơn Viên,Xã Quế Lâm',
        ],
        'Tỉnh Quảng Ngãi' => [
            'Thành phố Quảng Ngãi' => 'Phường Lê Hồng Phong,Phường Trần Phú,Phường Quảng Phú,Phường Nghĩa Chánh,Phường Trần Hưng Đạo,Phường Nguyễn Nghiêm,Phường Nghĩa Lộ,Phường Chánh Lộ,Xã Nghĩa Dũng,Xã Nghĩa Dõng,Phường Trương Quang Trọng,Xã Tịnh Hòa,Xã Tịnh Kỳ,Xã Tịnh Thiện,Xã Tịnh Ấn Đông,Xã Tịnh Châu,Xã Tịnh Khê,Xã Tịnh Long,Xã Tịnh Ấn Tây,Xã Tịnh An,Xã Nghĩa Phú,Xã Nghĩa Hà,Xã Nghĩa An',
            'Huyện Bình Sơn' => 'Thị Trấn Châu Ổ,Xã Bình Thuận,Xã Bình Thạnh,Xã Bình Đông,Xã Bình Chánh,Xã Bình Nguyên,Xã Bình Khương,Xã Bình Trị,Xã Bình An,Xã Bình Hải,Xã Bình Dương,Xã Bình Phước,Xã Bình Hòa,Xã Bình Trung,Xã Bình Minh,Xã Bình Long,Xã Bình Thanh ,Xã Bình Chương,Xã Bình Hiệp,Xã Bình Mỹ,Xã Bình Tân Phú,Xã Bình Châu',
            'Huyện Trà Bồng' => 'Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng,Huyện Trà Bồng',
            'Huyện Sơn Tịnh' => 'Xã Tịnh Thọ,Xã Tịnh Trà,Xã Tịnh Phong,Xã Tịnh Hiệp,Xã Tịnh Bình,Xã Tịnh Đông,Xã Tịnh Bắc,Xã Tịnh Sơn,Xã Tịnh Hà,Xã Tịnh Giang,Xã Tịnh Minh',
            'Huyện Tư Nghĩa' => 'Thị trấn La Hà,Thị trấn Sông Vệ,Xã Nghĩa Lâm,Xã Nghĩa Thắng,Xã Nghĩa Thuận,Xã Nghĩa Kỳ,Xã Nghĩa Sơn,Xã Nghĩa Hòa,Xã Nghĩa Điền,Xã Nghĩa Thương,Xã Nghĩa Trung,Xã Nghĩa Hiệp,Xã Nghĩa Phương,Xã Nghĩa Mỹ',
            'Huyện Sơn Hà' => 'Thị trấn Di Lăng,Xã Sơn Hạ,Xã Sơn Thành,Xã Sơn Nham,Xã Sơn Bao,Xã Sơn Linh,Xã Sơn Giang,Xã Sơn Trung,Xã Sơn Thượng,Xã Sơn Cao,Xã Sơn Hải,Xã Sơn Thủy,Xã Sơn Kỳ,Xã Sơn Ba',
            'Huyện Sơn Tây' => 'Xã Sơn Bua,Xã Sơn Mùa,Xã Sơn Liên,Xã Sơn Tân,Xã Sơn Màu,Xã Sơn Dung,Xã Sơn Long,Xã Sơn Tinh,Xã Sơn Lập',
            'Huyện Minh Long' => 'Xã Long Sơn,Xã Long Mai,Xã Thanh An,Xã Long Môn,Xã Long Hiệp',
            'Huyện Nghĩa Hành' => 'Thị trấn Chợ Chùa,Xã Hành Thuận,Xã Hành Dũng,Xã Hành Trung,Xã Hành Nhân,Xã Hành Đức,Xã Hành Minh,Xã Hành Phước,Xã Hành Thiện,Xã Hành Thịnh,Xã Hành Tín Tây,Xã Hành Tín Đông',
            'Huyện Mộ Đức' => 'Thị trấn Mộ Đức,Xã Đức Lợi,Xã Đức Thắng,Xã Đức Nhuận,Xã Đức Chánh,Xã Đức Hiệp,Xã Đức Minh,Xã Đức Thạnh,Xã Đức Hòa,Xã Đức Tân,Xã Đức Phú,Xã Đức Phong,Xã Đức Lân',
            'Thị xã Đức Phổ' => 'Phường Nguyễn Nghiêm,Xã Phổ An,Xã Phổ Phong,Xã Phổ Thuận,Phường Phổ Văn,Phường Phổ Quang,Xã Phổ Nhơn,Phường Phổ Ninh,Phường Phổ Minh,Phường Phổ Vinh,Phường Phổ Hòa,Xã Phổ Cường,Xã Phổ Khánh,Phường Phổ Thạnh,Xã Phổ Châu',
            'Huyện Ba Tơ' => 'Thị trấn Ba Tơ,Xã Ba Điền,Xã Ba Vinh,Xã Ba Thành,Xã Ba Động,Xã Ba Dinh,Xã Ba Giang,Xã Ba Liên,Xã Ba Ngạc,Xã Ba Khâm,Xã Ba Cung,Xã Ba Tiêu,Xã Ba Trang,Xã Ba Tô,Xã Ba Bích,Xã Ba Vì,Xã Ba Lế,Xã Ba Nam,Xã Ba Xa',
            'Huyện Lý Sơn' => null,
        ],
        'Tỉnh Bình Định' => [
            'Thành phố Quy Nhơn' => 'Phường Nhơn Bình,Phường Nhơn Phú,Phường Đống Đa,Phường Trần Quang Diệu,Phường Hải Cảng,Phường Quang Trung,Phường Thị Nại,Phường Lê Hồng Phong,Phường Trần Hưng Đạo,Phường Ngô Mây,Phường Lý Thường Kiệt,Phường Lê Lợi,Phường Trần Phú,Phường Bùi Thị Xuân,Phường Nguyễn Văn Cừ,Phường Ghềnh Ráng,Xã Nhơn Lý,Xã Nhơn Hội,Xã Nhơn Hải,Xã Nhơn Châu,Xã Phước Mỹ',
            'Huyện An Lão' => 'Thị trấn An Lão,Xã An Hưng,Xã An Trung,Xã An Dũng,Xã An Vinh,Xã An Toàn,Xã An Tân,Xã An Hòa,Xã An Quang,Xã An Nghĩa',
            'Thị xã Hoài Nhơn' => 'Phường Tam Quan,Phường Bồng Sơn,Xã Hoài Sơn,Xã Hoài Châu Bắc,Xã Hoài Châu,Xã Hoài Phú,Phường Tam Quan Bắc,Phường Tam Quan Nam,Phường Hoài Hảo,Phường Hoài Thanh Tây,Phường Hoài Thanh,Phường Hoài Hương,Phường Hoài Tân,Xã Hoài Hải,Phường Hoài Xuân,Xã Hoài Mỹ,Phường Hoài Đức',
            'Huyện Hoài Ân' => 'Thị trấn Tăng Bạt Hổ,Xã Ân Hảo Tây,Xã Ân Hảo Đông,Xã Ân Sơn,Xã Ân Mỹ,Xã Đak Mang,Xã Ân Tín,Xã Ân Thạnh,Xã Ân Phong,Xã Ân Đức,Xã Ân Hữu,Xã Bok Tới,Xã Ân Tường Tây,Xã Ân Tường Đông,Xã Ân Nghĩa',
            'Huyện Phù Mỹ' => 'Thị trấn Phù Mỹ,Thị trấn Bình Dương,Xã Mỹ Đức,Xã Mỹ Châu,Xã Mỹ Thắng,Xã Mỹ Lộc,Xã Mỹ Lợi,Xã Mỹ An,Xã Mỹ Phong,Xã Mỹ Trinh,Xã Mỹ Thọ,Xã Mỹ Hòa,Xã Mỹ Thành,Xã Mỹ Chánh,Xã Mỹ Quang,Xã Mỹ Hiệp,Xã Mỹ Tài,Xã Mỹ Cát,Xã Mỹ Chánh Tây',
            'Huyện Vĩnh Thạnh' => 'Thị trấn Vĩnh Thạnh,Xã Vĩnh Sơn,Xã Vĩnh Kim,Xã Vĩnh Hiệp,Xã Vĩnh Hảo,Xã Vĩnh Hòa,Xã Vĩnh Thịnh,Xã Vĩnh Thuận,Xã Vĩnh Quang',
            'Huyện Tây Sơn' => 'Thị trấn Phú Phong,Xã Bình Tân,Xã Tây Thuận,Xã Bình Thuận,Xã Tây Giang,Xã Bình Thành,Xã Tây An,Xã Bình Hòa,Xã Tây Bình,Xã Bình Tường,Xã Tây Vinh,Xã Vĩnh An,Xã Tây Xuân,Xã Bình Nghi,Xã Tây Phú',
            'Huyện Phù Cát' => 'Thị trấn Ngô Mây,Xã Cát Sơn,Xã Cát Minh,Xã Cát Khánh,Xã Cát Tài,Xã Cát Lâm,Xã Cát Hanh,Xã Cát Thành,Xã Cát Trinh,Xã Cát Hải,Xã Cát Hiệp,Xã Cát Nhơn,Xã Cát Hưng,Xã Cát Tường,Xã Cát Tân,Thị trấn Cát Tiến,Xã Cát Thắng,Xã Cát Chánh',
            'Thị xã An Nhơn' => 'Phường Bình Định,Phường Đập Đá,Xã Nhơn Mỹ,Phường Nhơn Thành,Xã Nhơn Hạnh,Xã Nhơn Hậu,Xã Nhơn Phong,Xã Nhơn An,Xã Nhơn Phúc,Phường Nhơn Hưng,Xã Nhơn Khánh,Xã Nhơn Lộc,Phường Nhơn Hoà,Xã Nhơn Tân,Xã Nhơn Thọ',
            'Huyện Tuy Phước' => 'Thị trấn Tuy Phước,Thị trấn Diêu Trì,Xã Phước Thắng,Xã Phước Hưng,Xã Phước Quang,Xã Phước Hòa,Xã Phước Sơn,Xã Phước Hiệp,Xã Phước Lộc,Xã Phước Nghĩa,Xã Phước Thuận,Xã Phước An,Xã Phước Thành',
            'Huyện Vân Canh' => 'Thị trấn Vân Canh,Xã Canh Liên,Xã Canh Hiệp,Xã Canh Vinh,Xã Canh Hiển,Xã Canh Thuận,Xã Canh Hòa',
        ],
        'Tỉnh Phú Yên' => [
            'Thành phố Tuy Hòa' => 'Phường 1,Phường 8,Phường 2,Phường 9,Phường 3,Phường 4,Phường 5,Phường 7,Phường 6,Phường Phú Thạnh,Phường Phú Đông,Xã Hòa Kiến,Xã Bình Kiến,Xã Bình Ngọc,Xã An Phú,Phường Phú Lâm',
            'Thị xã Sông Cầu' => 'Phường Xuân Phú,Xã Xuân Lâm,Phường Xuân Thành,Xã Xuân Hải,Xã Xuân Lộc,Xã Xuân Bình,Xã Xuân Cảnh,Xã Xuân Thịnh,Xã Xuân Phương,Phường Xuân Yên,Xã Xuân Thọ 1,Phường Xuân Đài,Xã Xuân Thọ 2',
            'Huyện Đồng Xuân' => 'Thị trấn La Hai,Xã Đa Lộc,Xã Phú Mỡ,Xã Xuân Lãnh,Xã Xuân Long,Xã Xuân Quang 1,Xã Xuân Sơn Bắc,Xã Xuân Quang 2,Xã Xuân Sơn Nam,Xã Xuân Quang 3,Xã Xuân Phước',
            'Huyện Tuy An' => 'Thị trấn Chí Thạnh,Xã An Dân,Xã An Ninh Tây,Xã An Ninh Đông,Xã An Thạch,Xã An Định,Xã An Nghiệp,Xã An Cư,Xã An Xuân,Xã An Lĩnh,Xã An Hòa Hải,Xã An Hiệp,Xã An Mỹ,Xã An Chấn,Xã An Thọ',
            'Huyện Sơn Hòa' => 'Thị trấn Củng Sơn,Xã Phước Tân,Xã Sơn Hội,Xã Sơn Định,Xã Sơn Long,Xã Cà Lúi,Xã Sơn Phước,Xã Sơn Xuân,Xã Sơn Nguyên,Xã Eachà Rang,Xã Krông Pa,Xã Suối Bạc,Xã Sơn Hà,Xã Suối Trai',
            'Huyện Sông Hình' => 'Thị trấn Hai Riêng,Xã Ea Lâm,Xã Đức Bình Tây,Xã Ea Bá,Xã Sơn Giang,Xã Đức Bình Đông,Xã EaBar,Xã EaBia,Xã EaTrol,Xã Sông Hinh,Xã Ealy',
            'Huyện Tây Hòa' => 'Xã Sơn Thành Tây,Xã Sơn Thành Đông,Xã Hòa Bình 1,Thị trấn Phú Thứ,Xã Hòa Phong,Xã Hòa Phú,Xã Hòa Tân Tây,Xã Hòa Đồng,Xã Hòa Mỹ Đông,Xã Hòa Mỹ Tây,Xã Hòa Thịnh',
            'Huyện Phú Hòa' => 'Xã Hòa Quang Bắc,Xã Hòa Quang Nam,Xã Hòa Hội,Xã Hòa Trị,Xã Hòa An,Xã Hòa Định Đông,Thị Trấn Phú Hoà,Xã Hòa Định Tây,Xã Hòa Thắng',
            'Thị xã Đông Hòa' => 'Xã Hòa Thành,Phường Hòa Hiệp Bắc,Phường Hoà Vinh,Phường Hoà Hiệp Trung,Xã Hòa Tân Đông,Phường Hòa Xuân Tây,Phường Hòa Hiệp Nam,Xã Hòa Xuân Đông,Xã Hòa Tâm,Xã Hòa Xuân Nam',
        ],
        'Tỉnh Khánh Hòa' => [
            'Thành phố Nha Trang' => 'Phường Vĩnh Hòa,Phường Vĩnh Hải,Phường Vĩnh Phước,Phường Ngọc Hiệp,Phường Vĩnh Thọ,Phường Xương Huân,Phường Vạn Thắng,Phường Vạn Thạnh,Phường Phương Sài,Phường Phương Sơn,Phường Phước Hải,Phường Phước Tân,Phường Lộc Thọ,Phường Phước Tiến,Phường Tân Lập,Phường Phước Hòa,Phường Vĩnh Nguyên,Phường Phước Long,Phường Vĩnh Trường,Xã Vĩnh Lương,Xã Vĩnh Phương,Xã Vĩnh Ngọc,Xã Vĩnh Thạnh,Xã Vĩnh Trung,Xã Vĩnh Hiệp,Xã Vĩnh Thái,Xã Phước Đồng',
            'Thành phố Cam Ranh' => 'Phường Cam Nghĩa,Phường Cam Phúc Bắc,Phường Cam Phúc Nam,Phường Cam Lộc,Phường Cam Phú,Phường Ba Ngòi,Phường Cam Thuận,Phường Cam Lợi,Phường Cam Linh,Xã Cam Thành Nam,Xã Cam Phước Đông,Xã Cam Thịnh Tây,Xã Cam Thịnh Đông,Xã Cam Lập,Xã Cam Bình',
            'Huyện Cam Lâm' => 'Xã Cam Tân,Xã Cam Hòa,Xã Cam Hải Đông,Xã Cam Hải Tây,Xã Sơn Tân,Xã Cam Hiệp Bắc,Thị trấn Cam Đức,Xã Cam Hiệp Nam,Xã Cam Phước Tây,Xã Cam Thành Bắc,Xã Cam An Bắc,Xã Cam An Nam,Xã Suối Cát,Xã Suối Tân',
            'Thị trấn Vạn Giã,Xã Đại Lãnh,Xã Vạn Phước,Xã Vạn Long,Xã Vạn Bình,Xã Vạn Thọ,Xã Vạn Khánh,Xã Vạn Phú,Xã Vạn Lương,Xã Vạn Thắng,Xã Vạn Thạnh,Xã Xuân Sơn,Xã Vạn Hưng',
            'Thị xã Ninh Hòa' => 'Phường Ninh Hiệp,Xã Ninh Sơn,Xã Ninh Tây,Xã Ninh Thượng,Xã Ninh An,Phường Ninh Hải,Xã Ninh Thọ,Xã Ninh Trung,Xã Ninh Sim,Xã Ninh Xuân,Xã Ninh Thân,Phường Ninh Diêm,Xã Ninh Đông,Phường Ninh Thủy,Phường Ninh Đa,Xã Ninh Phụng,Xã Ninh Bình,Xã Ninh Phước,Xã Ninh Phú,Xã Ninh Tân,Xã Ninh Quang,Phường Ninh Giang,Phường Ninh Hà,Xã Ninh Hưng,Xã Ninh Lộc,Xã Ninh Ích,Xã Ninh Vân',
            'Huyện Khánh Vĩnh' => 'Thị trấn Khánh Vĩnh,Xã Khánh Hiệp,Xã Khánh Bình,Xã Khánh Trung,Xã Khánh Đông,Xã Khánh Thượng,Xã Khánh Nam,Xã Sông Cầu,Xã Giang Ly,Xã Cầu Bà,Xã Liên Sang,Xã Khánh Thành,Xã Khánh Phú,Xã Sơn Thái',
            'Huyện Diên Khánh' => 'Thị trấn Diên Khánh,Xã Diên Lâm,Xã Diên Điền,Xã Diên Xuân,Xã Diên Sơn,Xã Diên Đồng,Xã Diên Phú,Xã Diên Thọ,Xã Diên Phước,Xã Diên Lạc,Xã Diên Tân,Xã Diên Hòa,Xã Diên Thạnh,Xã Diên Toàn,Xã Diên An,Xã Bình Lộc,Xã Suối Hiệp,Xã Suối Tiên',
            'Huyện Khánh Sơn' => 'Thị trấn Tô Hạp,Xã Thành Sơn,Xã Sơn Lâm,Xã Sơn Hiệp,Xã Sơn Bình,Xã Sơn Trung,Xã Ba Cụm Bắc,Xã Ba Cụm Nam',
            'Huyện Trường Sa' => 'Thị trấn Trường Sa,Xã Song Tử Tây,Xã Sinh Tồn',
        ],
        'Tỉnh Ninh Thuận' => [
            'Thành phố Phan Rang-Tháp Chàm' => 'Phường Đô Vinh,Phường Phước Mỹ,Phường Bảo An,Phường Phủ Hà,Phường Thanh Sơn,Phường Mỹ Hương,Phường Tấn Tài,Phường Kinh Dinh,Phường Đạo Long,Phường Đài Sơn,Phường Đông Hải,Phường Mỹ Đông,Xã Thành Hải,Phường Văn Hải,Phường Mỹ Bình,Phường Mỹ Hải',
            'Huyện Bác Ái' => 'Xã Phước Bình,Xã Phước Hòa,Xã Phước Tân,Xã Phước Tiến,Xã Phước Thắng,Xã Phước Thành,Xã Phước Đại,Xã Phước Chính,Xã Phước Trung',
            'Huyện Ninh Sơn' => 'Thị trấn Tân Sơn,Xã Lâm Sơn,Xã Lương Sơn,Xã Quảng Sơn,Xã Mỹ Sơn,Xã Hòa Sơn,Xã Ma Nới,Xã Nhơn Sơn',
            'Huyện Ninh Hải' => 'Thị trấn Khánh Hải,Xã Vĩnh Hải,Xã Phương Hải,Xã Tân Hải,Xã Xuân Hải,Xã Hộ Hải,Xã Tri Hải,Xã Nhơn Hải,Xã Thanh Hải',
            'Huyện Ninh Phước' => 'Thị trấn Phước Dân,Xã Phước Sơn,Xã Phước Thái,Xã Phước Hậu,Xã Phước Thuận,Xã An Hải,Xã Phước Hữu,Xã Phước Hải,Xã Phước Vinh',
            'Huyện Thuận Bắc' => 'Xã Công Hải,Xã Phước Kháng,Xã Lợi Hải,Xã Bắc Sơn,Xã Bắc Phong',
            'Huyện Thuận Nam' => 'Xã Phước Hà,Xã Phước Nam,Xã Phước Ninh,Xã Nhị Hà,Xã Phước Dinh,Xã Phước Minh,Xã Phước Diêm,Xã Cà Ná',
        ],
        'Tỉnh Bình Thuận' => [
            'Thành phố Phan Thiết' => 'Phường Mũi Né,Phường Hàm Tiến,Phường Phú Hài,Phường Phú Thủy,Phường Phú Tài,Phường Phú Trinh,Phường Xuân An,Phường Thanh Hải,Phường Bình Hưng,Phường Đức Nghĩa,Phường Lạc Đạo,Phường Đức Thắng,Phường Hưng Long,Phường Đức Long,Xã Thiện Nghiệp,Xã Phong Nẫm,Xã Tiến Lợi,Xã Tiến Thành',
            'Thị xã La Gi' => 'Phường Phước Hội,Phường Phước Lộc,Phường Tân Thiện,Phường Tân An,Phường Bình Tân,Xã Tân Hải,Xã Tân Tiến,Xã Tân Bình,Xã Tân Phước',
            'Huyện Tuy Phong' => 'Thị trấn Liên Hương,Thị trấn Phan Rí Cửa,Xã Phan Dũng,Xã Phong Phú,Xã Vĩnh Hảo,Xã Vĩnh Tân,Xã Phú Lạc,Xã Phước Thể,Xã Hòa Minh,Xã Chí Công,Xã Bình Thạnh',
            'Huyện Bắc Bình' => 'Thị trấn Chợ Lầu,Xã Phan Sơn,Xã Phan Lâm,Xã Bình An,Xã Phan Điền,Xã Hải Ninh,Xã Sông Lũy,Xã Phan Tiến,Xã Sông Bình,Thị trấn Lương Sơn,Xã Phan Hòa,Xã Phan Thanh,Xã Hồng Thái,Xã Phan Hiệp,Xã Bình Tân,Xã Phan Rí Thành,Xã Hòa Thắng,Xã Hồng Phong',
            'Huyện Hàm Thuận Bắc' => 'Thị trấn Ma Lâm,Thị trấn Phú Long,Xã La Dạ,Xã Đông Tiến,Xã Thuận Hòa,Xã Đông Giang,Xã Hàm Phú,Xã Hồng Liêm,Xã Thuận Minh,Xã Hồng Sơn,Xã Hàm Trí,Xã Hàm Đức,Xã Hàm Liêm,Xã Hàm Chính,Xã Hàm Hiệp,Xã Hàm Thắng,Xã Đa Mi',
            'Huyện Hàm Thuận Nam' => 'Thị trấn Thuận Nam,Xã Mỹ Thạnh,Xã Hàm Cần,Xã Mương Mán,Xã Hàm Thạnh,Xã Hàm Kiệm,Xã Hàm Cường,Xã Hàm Mỹ,Xã Tân Lập,Xã Hàm Minh,Xã Thuận Quí,Xã Tân Thuận,Xã Tân Thành',
            'Huyện Tánh Linh' => 'Thị trấn Lạc Tánh,Xã Bắc Ruộng,Xã Nghị Đức,Xã La Ngâu,Xã Huy Khiêm,Xã Măng Tố,Xã Đức Phú,Xã Đồng Kho,Xã Gia An,Xã Đức Bình,Xã Gia Huynh,Xã Đức Thuận,Xã Suối Kiết',
            'Huyện Đức Linh' => 'Thị trấn Võ Xu,Thị trấn Đức Tài,Xã Đa Kai,Xã Sùng Nhơn,Xã Mê Pu,Xã Nam Chính,Xã Đức Hạnh,Xã Đức Tín,Xã Vũ Hoà,Xã Tân Hà,Xã Đông Hà,Xã Trà Tân',
            'Huyện Hàm Tân' => 'Thị trấn Tân Minh,Thị trấn Tân Nghĩa,Xã Sông Phan,Xã Tân Phúc,Xã Tân Đức,Xã Tân Thắng,Xã Thắng Hải,Xã Tân Hà,Xã Tân Xuân,Xã Sơn Mỹ',
            'Huyện Phú Quí' => 'Xã Ngũ Phụng,Xã Long Hải,Xã Tam Thanh',
        ],
        'Tỉnh Kon Tum' => [
            'Thành phố Kon Tum' => 'Phường Quang Trung,Phường Duy Tân,Phường Quyết Thắng,Phường Trường Chinh,Phường Thắng Lợi,Phường Ngô Mây,Phường Thống Nhất,Phường Lê Lợi,Phường Nguyễn Trãi,Phường Trần Hưng Đạo,Xã Đắk Cấm,Xã Kroong,Xã Ngọk Bay,Xã Vinh Quang,Xã Đắk Blà,Xã Ia Chim,Xã Đăk Năng,Xã Đoàn Kết,Xã Chư Hreng,Xã Đắk Rơ Wa,Xã Hòa Bình',
            'Huyện Đắk Glei' => 'Thị trấn Đắk Glei,Xã Đắk Blô,Xã Đắk Man,Xã Đắk Nhoong,Xã Đắk Pék,Xã Đắk Choong,Xã Xốp,Xã Mường Hoong,Xã Ngọc Linh,Xã Đắk Long,Xã Đắk KRoong,Xã Đắk Môn',
            'Huyện Ngọc Hồi' => 'Thị trấn Plei Kần,Xã Đắk Ang,Xã Đắk Dục,Xã Đắk Nông,Xã Đắk Xú,Xã Đắk Kan,Xã Bờ Y,Xã Sa Loong',
            'Huyện Đắk Tô' => 'Thị trấn Đắk Tô,Xã Đắk Rơ Nga,Xã Ngọk Tụ,Xã Đắk Trăm,Xã Văn Lem,Xã Kon Đào,Xã Tân Cảnh,Xã Diên Bình,Xã Pô Kô',
            'Huyện Kon Plông' => 'Xã Đắk Nên,Xã Đắk Ring,Xã Măng Buk,Xã Đắk Tăng,Xã Ngok Tem,Xã Pờ Ê,Xã Măng Cành,Thị trấn Măng Đen,Xã Hiếu',
            'Huyện Kon Rẫy' => 'Thị trấn Đắk Rve,Xã Đắk Kôi,Xã Đắk Tơ Lung,Xã Đắk Ruồng,Xã Đắk Pne,Xã Đắk Tờ Re,Xã Tân Lập',
            'Huyện Đắk Hà' => 'Thị trấn Đắk Hà,Xã Đắk PXi,Xã Đăk Long,Xã Đắk HRing,Xã Đắk Ui,Xã Đăk Ngọk,Xã Đắk Mar,Xã Ngok Wang,Xã Ngok Réo,Xã Hà Mòn,Xã Đắk La',
            'Huyện Sa Thầy' => 'Thị trấn Sa Thầy,Xã Rơ Kơi,Xã Sa Nhơn,Xã Hơ Moong,Xã Mô Rai,Xã Sa Sơn,Xã Sa Nghĩa,Xã Sa Bình,Xã Ya Xiêr,Xã Ya Tăng,Xã Ya ly',
            'Huyện Tu Mơ Rông' => 'Xã Ngọc Lây,Xã Đắk Na,Xã Măng Ri,Xã Ngọc Yêu,Xã Đắk Sao,Xã Đắk Rơ Ông,Xã Đắk Tờ Kan,Xã Tu Mơ Rông,Xã Đắk Hà,Xã Tê Xăng,Xã Văn Xuôi',
            "Huyện Ia H' Drai" => 'Xã Ia Đal,Xã Ia Dom,Xã Ia Tơi',
        ],
        'Tỉnh Gia Lai' => [
            'Thành phố Pleiku' => 'Phường Yên Đỗ,Phường Diên Hồng,Phường Ia Kring,Phường Hội Thương,Phường Hội Phú,Phường Phù Đổng,Phường Hoa Lư,Phường Tây Sơn,Phường Thống Nhất,Phường Đống Đa,Phường Trà Bá,Phường Thắng Lợi,Phường Yên Thế,Phường Chi Lăng,Xã Biển Hồ,Xã Tân Sơn,Xã Trà Đa,Xã Chư Á,Xã An Phú,Xã Diên Phú,Xã Ia Kênh,Xã Gào',
            'Thị xã An Khê' => 'Phường An Bình,Phường Tây Sơn,Phường An Phú,Phường An Tân,Xã Tú An,Xã Xuân An,Xã Cửu An,Phường An Phước,Xã Song An,Phường Ngô Mây,Xã Thành An',
            'Thị Xã Ayun Pa' => 'Phường Cheo Reo,Phường Hòa Bình,Phường Đoàn Kết,Phường Sông Bờ,Xã Ia RBol,Xã Chư Băh,Xã Ia RTô,Xã Ia Sao',
            'Huyện KBang' => 'Thị trấn KBang,Xã Kon Pne,Xã Đăk Roong,Xã Sơn Lang,Xã KRong,Xã Sơ Pai,Xã Lơ Ku,Xã Đông,Xã Đak SMar,Xã Nghĩa An,Xã Tơ Tung,Xã Kông Lơng Khơng,Xã Kông Pla,Xã Đăk HLơ',
            'Huyện Đăk Đoa' => "Thị trấn Đăk Đoa,Xã Hà Đông,Xã Đăk Sơmei,Xã Đăk Krong,Xã Hải Yang,Xã Kon Gang,Xã Hà Bầu,Xã Nam Yang,Xã K' Dang,Xã H' Neng,Xã Tân Bình,Xã Glar,Xã A Dơk,Xã Trang,Xã HNol,Xã Ia Pết,Xã Ia Băng",
            'Huyện Chư Păh' => 'Thị trấn Phú Hòa,Xã Hà Tây,Xã Ia Khươl,Xã Ia Phí,Thị trấn Ia Ly,Xã Ia Mơ Nông,Xã Ia Kreng,Xã Đăk Tơ Ver,Xã Hòa Phú,Xã Chư Đăng Ya,Xã Ia Ka,Xã Ia Nhin,Xã Nghĩa Hòa,Xã Nghĩa Hưng',
            'Huyện Ia Grai' => 'Thị trấn Ia Kha,Xã Ia Sao,Xã Ia Yok,Xã Ia Hrung,Xã Ia Bă,Xã Ia Khai,Xã Ia KRai,Xã Ia Grăng,Xã Ia Tô,Xã Ia O,Xã Ia Dêr,Xã Ia Chia,Xã Ia Pếch',
            'Huyện Mang Yang' => 'Thị trấn Kon Dơng,Xã Ayun,Xã Đak Jơ Ta,Xã Đak Ta Ley,Xã Hra,Xã Đăk Yă,Xã Đăk Djrăng,Xã Lơ Pang,Xã Kon Thụp,Xã Đê Ar,Xã Kon Chiêng,Xã Đăk Trôi',
            'Huyện Kông Chro' => 'Thị trấn Kông Chro,Xã Chư Krêy,Xã An Trung,Xã Kông Yang,Xã Đăk Tơ Pang,Xã SRó,Xã Đắk Kơ Ning,Xã Đăk Song,Xã Đăk Pling,Xã Yang Trung,Xã Đăk Pơ Pho,Xã Ya Ma,Xã Chơ Long,Xã Yang Nam',
            'Huyện Đức Cơ' => 'Thị trấn Chư Ty,Xã Ia Dơk,Xã Ia Krêl,Xã Ia Din,Xã Ia Kla,Xã Ia Dom,Xã Ia Lang,Xã Ia Kriêng,Xã Ia Pnôn,Xã Ia Nan',
            'Huyện Chư Prông' => 'Thị trấn Chư Prông,Xã Ia Kly,Xã Bình Giáo,Xã Ia Drăng,Xã Thăng Hưng,Xã Bàu Cạn,Xã Ia Phìn,Xã Ia Băng,Xã Ia Tôr,Xã Ia Boòng,Xã Ia O,Xã Ia Púch,Xã Ia Me,Xã Ia Vê,Xã Ia Bang,Xã Ia Pia,Xã Ia Ga,Xã Ia Lâu,Xã Ia Piơr,Xã Ia Mơ',
            'Huyện Chư Sê' => 'Thị trấn Chư Sê,Xã Ia Tiêm,Xã Chư Pơng,Xã Bar Măih,Xã Bờ Ngoong,Xã Ia Glai,Xã AL Bá,Xã Kông HTok,Xã AYun,Xã Ia HLốp,Xã Ia Blang,Xã Dun,Xã Ia Pal,Xã H Bông,Xã Ia Ko',
            'Huyện Đăk Pơ' => 'Xã Hà Tam,Xã An Thành,Thị trấn Đak Pơ,Xã Yang Bắc,Xã Cư An,Xã Tân An,Xã Phú An,Xã Ya Hội',
            'Huyện Ia Pa' => 'Xã Pờ Tó,Xã Chư Răng,Xã Ia KDăm,Xã Kim Tân,Xã Chư Mố,Xã Ia Tul,Xã Ia Ma Rơn,Xã Ia Broăi,Xã Ia Trok',
            'Huyện Krông Pa' => 'Thị trấn Phú Túc,Xã Ia RSai,Xã Ia RSươm,Xã Chư Gu,Xã Đất Bằng,Xã Ia Mláh,Xã Chư Drăng,Xã Phú Cần,Xã Ia HDreh,Xã Ia RMok,Xã Chư Ngọc,Xã Uar,Xã Chư Rcăm,Xã Krông Năng',
            'Huyện Phú Thiện' => 'Thị trấn Phú Thiện,Xã Chư A Thai,Xã Ayun Hạ,Xã Ia Ake,Xã Ia Sol,Xã Ia Piar,Xã Ia Peng,Xã Chrôh Pơnan,Xã Ia Hiao,Xã Ia Yeng',
            'Huyện Chư Pưh' => 'Thị trấn Nhơn Hoà,Xã Ia Hrú,Xã Ia Rong,Xã Ia Dreng,Xã Ia Hla,Xã Chư Don,Xã Ia Phang,Xã Ia Le,Xã Ia BLứ',
        ],
        'Tỉnh Đắk Lắk' => [
            'Thành phố Buôn Ma Thuột' => 'Phường Tân Lập,Phường Tân Hòa,Phường Tân An,Phường Thống Nhất,Phường Thành Nhất,Phường Thắng Lợi,Phường Tân Lợi,Phường Thành Công,Phường Tân Thành,Phường Tân Tiến,Phường Tự An,Phường Ea Tam,Phường Khánh Xuân,Xã Hòa Thuận,Xã Cư ÊBur,Xã Ea Tu,Xã Hòa Thắng,Xã Ea Kao,Xã Hòa Phú,Xã Hòa Khánh,Xã Hòa Xuân',
            'Thị Xã Buôn Hồ' => 'Phường An Lạc,Phường An Bình,Phường Thiện An,Phường Đạt Hiếu,Phường Đoàn Kết,Xã Ea Blang,Xã Ea Drông,Phường Thống Nhất,Phường Bình Tân,Xã Ea Siên,Xã Bình Thuận,Xã Cư Bao',
            "Huyện Ea H'leo" => "Thị trấn Ea Drăng,Xã Ea H'leo,Xã Ea Sol,Xã Ea Ral,Xã Ea Wy,Xã Cư A Mung,Xã Cư Mốt,Xã Ea Hiao,Xã Ea Khal,Xã Dliê Yang,Xã Ea Tir,Xã Ea Nam",
            "Huyện Ea Súp" => "Thị trấn Ea Súp,Xã Ia Lốp,Xã Ia JLơi,Xã Ea Rốk,Xã Ya Tờ Mốt,Xã Ia RVê,Xã Ea Lê,Xã Cư KBang,Xã Ea Bung,Xã Cư M'Lan",
            "Huyện Buôn Đôn" => "Xã Krông Na,Xã Ea Huar,Xã Ea Wer,Xã Tân Hoà,Xã Cuôr KNia,Xã Ea Bar,Xã Ea Nuôl",
            "Huyện Cư M'gar" => "Thị trấn Ea Pốk,Thị trấn Quảng Phú,Xã Quảng Tiến,Xã Ea Kuêh,Xã Ea Kiết,Xã Ea Tar,Xã Cư Dliê M'nông,Xã Ea H'đinh,Xã Ea Tul,Xã Ea KPam,Xã Ea M'DRóh,Xã Quảng Hiệp,Xã Cư M'gar,Xã Ea D'Rơng,Xã Ea M'nang,Xã Cư Suê,Xã Cuor Đăng",
            "Huyện Krông Búk" => "Xã Cư Né,Xã Chư KBô,Xã Cư Pơng,Xã Ea Sin,Xã Pơng Drang,Xã Tân Lập,Xã Ea Ngai",
            "Huyện Krông Năng" => "Thị trấn Krông Năng,Xã ĐLiê Ya,Xã Ea Tóh,Xã Ea Tam,Xã Phú Lộc,Xã Tam Giang,Xã Ea Puk,Xã Ea Dăh,Xã Ea Hồ,Xã Phú Xuân,Xã Cư Klông,Xã Ea Tân",
            "Huyện Ea Kar" => "Thị trấn Ea Kar,Thị trấn Ea Knốp,Xã Ea Sô,Xã Ea Sar,Xã Xuân Phú,Xã Cư Huê,Xã Ea Tih,Xã Ea Đar,Xã Ea Kmút,Xã Cư Ni,Xã Ea Păl,Xã Cư Prông,Xã Ea Ô,Xã Cư ELang,Xã Cư Bông,Xã Cư Jang",
            "Huyện M'Đrắk" => "Thị trấn M'Đrắk,Xã Cư Prao,Xã Ea Pil,Xã Ea Lai,Xã Ea H'MLay,Xã Krông Jing,Xã Ea M' Doal,Xã Ea Riêng,Xã Cư M'ta,Xã Cư K Róa,Xã Krông Á,Xã Cư San,Xã Ea Trang",
            "Huyện Krông Bông" => "Thị trấn Krông Kmar,Xã Dang Kang,Xã Cư KTy,Xã Hòa Thành,Xã Hòa Tân,Xã Hòa Phong,Xã Hòa Lễ,Xã Yang Reh,Xã Ea Trul,Xã Khuê Ngọc Điền,Xã Cư Pui,Xã Hòa Sơn,Xã Cư Drăm,Xã Yang Mao",
            "Huyện Krông Pắc" => "Thị trấn Phước An,Xã KRông Búk,Xã Ea Kly,Xã Ea Kênh,Xã Ea Phê,Xã Ea KNuec,Xã Ea Yông,Xã Hòa An,Xã Ea Kuăng,Xã Hòa Đông,Xã Ea Hiu,Xã Hòa Tiến,Xã Tân Tiến,Xã Vụ Bổn,Xã Ea Uy,Xã Ea Yiêng",
            "Huyện Krông A Na" => "Thị trấn Buôn Trấp,Xã Dray Sáp,Xã Ea Na,Xã Ea Bông,Xã Băng A Drênh,Xã Dur KMăl,Xã Bình Hòa,Xã Quảng Điền",
            "Huyện Lắk" => "Thị trấn Liên Sơn,Xã Yang Tao,Xã Bông Krang,Xã Đắk Liêng,Xã Buôn Triết,Xã Buôn Tría,Xã Đắk Phơi,Xã Đắk Nuê,Xã Krông Nô,Xã Nam Ka,Xã Ea R'Bin",
            "Huyện Cư Kuin" => "Xã Ea Ning,Xã Cư Ê Wi,Xã Ea Ktur,Xã Ea Tiêu,Xã Ea BHốk,Xã Ea Hu,Xã Dray Bhăng,Xã Hòa Hiệp",
        ],
        'Tỉnh Đắk Nông' => [
            'Thành phố Gia Nghĩa' => "Phường Nghĩa Đức,Phường Nghĩa Thành,Phường Nghĩa Phú,Phường Nghĩa Tân,Phường Nghĩa Trung,Xã Đăk R'Moan,Phường Quảng Thành,Xã Đắk Nia",
            "Huyện Đăk Glong" => "Xã Quảng Sơn,Xã Quảng Hoà,Xã Đắk Ha,Xã Đắk R'Măng,Xã Quảng Khê,Xã Đắk Plao,Xã Đắk Som",
            "Huyện Cư Jút" => "Thị trấn Ea T'Ling,Xã Đắk Wil,Xã Ea Pô,Xã Nam Dong,Xã Đắk DRông,Xã Tâm Thắng,Xã Cư Knia,Xã Trúc Sơn",
            "Huyện Đắk Mil" => "Thị trấn Đắk Mil,Xã  Đắk Lao,Xã Đắk R'La,Xã Đắk Gằn,Xã Đức Mạnh,Xã Đắk N'Drót,Xã Long Sơn,Xã Đắk Sắk,Xã Thuận An,Xã Đức Minh",
            "Huyện Krông Nô" => "Thị trấn Đắk Mâm,Xã Đắk Sôr,Xã Nam Xuân,Xã Buôn Choah,Xã Nam Đà,Xã Tân Thành,Xã Đắk Drô,Xã Nâm Nung,Xã Đức Xuyên,Xã Đắk Nang,Xã Quảng Phú,Xã Nâm N'Đir",
            "Huyện Đắk Song" => "Thị trấn Đức An,Xã Đắk Môl,Xã Đắk Hòa,Xã Nam Bình,Xã Thuận Hà,Xã Thuận Hạnh,Xã Đắk N'Dung,Xã Nâm N'Jang,Xã Trường Xuân",
            "Huyện Đắk R'Lấp" => "Thị trấn Kiến Đức,Xã Quảng Tín,Xã Đắk Wer,Xã Nhân Cơ,Xã Kiến Thành,Xã Nghĩa Thắng,Xã Đạo Nghĩa,Xã Đắk Sin,Xã Hưng Bình,Xã Đắk Ru,Xã Nhân Đạo",
            "Huyện Tuy Đức" => "Xã Quảng Trực,Xã Đắk Búk So,Xã Quảng Tâm,Xã Đắk R'Tíh,Xã Đắk Ngo,Xã Quảng Tân",
        ],
        'Tỉnh Lâm Đồng' => [
            "Thành phố Đà Lạt" => "Phường 7,Phường 8,Phường 12,Phường 9,Phường 2,Phường 1,Phường 6,Phường 5,Phường 4,Phường 10,Phường 11,Phường 3,Xã Xuân Thọ,Xã Tà Nung,Xã Trạm Hành,Xã Xuân Trường",
            "Thành phố Bảo Lộc" => "Phường Lộc Phát,Phường Lộc Tiến,Phường 2,Phường 1,Phường B'lao,Phường Lộc Sơn,Xã Đạm Bri,Xã Lộc Thanh,Xã Lộc Nga,Xã Lộc Châu,Xã Đại Lào",
            "Huyện Đam Rông" => "Xã Đạ Tông,Xã Đạ Long,Xã Đạ M' Rong,Xã Liêng Srônh,Xã Đạ Rsal,Xã Rô Men,Xã Phi Liêng,Xã Đạ K' Nàng",
            "Huyện Lạc Dương" => "Thị trấn Lạc Dương,Xã Đạ Chais,Xã Đạ Nhim,Xã Đưng KNớ,Xã Lát,Xã Đạ Sar",
            "Huyện Lâm Hà" => "Thị trấn Nam Ban,Thị trấn Đinh Văn,Xã Phú Sơn,Xã Phi Tô,Xã Mê Linh,Xã Đạ Đờn,Xã Phúc Thọ,Xã Đông Thanh,Xã Gia Lâm,Xã Tân Thanh,Xã Tân Văn,Xã Hoài Đức,Xã Tân Hà,Xã Liên Hà,Xã Đan Phượng,Xã Nam Hà",
            "Huyện Đơn Dương" => "Thị trấn D'Ran,Thị trấn Thạnh Mỹ,Xã Lạc Xuân,Xã Đạ Ròn,Xã Lạc Lâm,Xã Ka Đô,Xã Quảng Lập,Xã Ka Đơn,Xã Tu Tra,Xã Pró",
            "Huyện Đức Trọng" => "Thị trấn Liên Nghĩa,Xã Hiệp An,Xã Liên Hiệp,Xã Hiệp Thạnh,Xã Bình Thạnh,Xã N'Thol Hạ,Xã Tân Hội,Xã Tân Thành,Xã Phú Hội,Xã Ninh Gia,Xã Tà Năng,Xã Đa Quyn,Xã Tà Hine,Xã Đà Loan,Xã Ninh Loan",
            "Huyện Di Linh" => "Thị trấn Di Linh,Xã Đinh Trang Thượng,Xã Tân Thượng,Xã Tân Lâm,Xã Tân Châu,Xã Tân Nghĩa,Xã Gia Hiệp,Xã Đinh Lạc,Xã Tam Bố,Xã Đinh Trang Hòa,Xã Liên Đầm,Xã Gung Ré,Xã Bảo Thuận,Xã Hòa Ninh,Xã Hòa Trung,Xã Hòa Nam,Xã Hòa Bắc,Xã Sơn Điền,Xã Gia Bắc",
            "Huyện Bảo Lâm" => "Thị trấn Lộc Thắng,Xã Lộc Bảo,Xã Lộc Lâm,Xã Lộc Phú,Xã Lộc Bắc,Xã B' Lá,Xã Lộc Ngãi,Xã Lộc Quảng,Xã Lộc Tân,Xã Lộc Đức,Xã Lộc An,Xã Tân Lạc,Xã Lộc Thành,Xã Lộc Nam",
            "Huyện Đạ Huoai" => "Thị trấn Đạ M'ri,Thị trấn Ma Đa Guôi,Xã Hà Lâm,Xã Đạ Tồn,Xã Đạ Oai,Xã Đạ Ploa,Xã Ma Đa Guôi,Xã Đoàn Kết,Xã Phước Lộc",
            "Huyện Đạ Tẻh" => "Thị trấn Đạ Tẻh,Xã An Nhơn,Xã Quốc Oai,Xã Mỹ Đức,Xã Quảng Trị,Xã Đạ Lây,Xã Triệu Hải,Xã Đạ Kho,Xã Đạ Pal",
            "Huyện Cát Tiên" => "Thị trấn Cát Tiên,Xã Tiên Hoàng,Xã Phước Cát 2,Xã Gia Viễn,Xã Nam Ninh,Thị trấn Phước Cát ,Xã Đức Phổ,Xã Quảng Ngãi,Xã Đồng Nai Thượng",
        ],
        'Tỉnh Bình Phước' => [
            'Thị xã Phước Long' => "Phường Thác Mơ,Phường Long Thủy,Phường Phước Bình,Phường Long Phước,Phường Sơn Giang,Xã Long Giang,Xã Phước Tín",
            "Thành phố Đồng Xoài" => "Phường Tân Phú,Phường Tân Đồng,Phường Tân Bình,Phường Tân Xuân,Phường Tân Thiện,Xã Tân Thành,Phường Tiến Thành,Xã Tiến Hưng",
            "Thị xã Bình Long" => "Phường Hưng Chiến,Phường An Lộc,Phường Phú Thịnh,Phường Phú Đức,Xã Thanh Lương,Xã Thanh Phú",
            "Huyện Bù Gia Mập" => "Xã Bù Gia Mập,Xã Đak Ơ,Xã Đức Hạnh,Xã Phú Văn,Xã Đa Kia,Xã Phước Minh,Xã Bình Thắng,Xã Phú Nghĩa",
            "Huyện Lộc Ninh" => "Thị trấn Lộc Ninh,Xã Lộc Hòa,Xã Lộc An,Xã Lộc Tấn,Xã Lộc Thạnh,Xã Lộc Hiệp,Xã Lộc Thiện,Xã Lộc Thuận,Xã Lộc Quang,Xã Lộc Phú,Xã Lộc Thành,Xã Lộc Thái,Xã Lộc Điền,Xã Lộc Hưng,Xã Lộc Thịnh,Xã Lộc Khánh",
            "Huyện Bù Đốp" => "Thị trấn Thanh Bình,Xã Hưng Phước,Xã Phước Thiện,Xã Thiện Hưng,Xã Thanh Hòa,Xã Tân Thành,Xã Tân Tiến",
            "Huyện Hớn Quản" => "Xã Thanh An,Xã An Khương,Xã An Phú,Xã Tân Lợi,Xã Tân Hưng,Xã Minh Đức,Xã Minh Tâm,Xã Phước An,Xã Thanh Bình,Thị trấn Tân Khai,Xã Đồng Nơ,Xã Tân Hiệp,Xã Tân Quan",
            "Huyện Đồng Phú" => "Thị trấn Tân Phú,Xã Thuận Lợi,Xã Đồng Tâm,Xã Tân Phước,Xã Tân Hưng,Xã Tân Lợi,Xã Tân Lập,Xã Tân Hòa,Xã Thuận Phú,Xã Đồng Tiến,Xã Tân Tiến",
            "Huyện Bù Đăng" => "Thị trấn Đức Phong,Xã Đường 10,Xã Đak Nhau,Xã Phú Sơn,Xã Thọ Sơn,Xã Bình Minh,Xã Bom Bo,Xã Minh Hưng,Xã Đoàn Kết,Xã Đồng Nai,Xã Đức Liễu,Xã Thống Nhất,Xã Nghĩa Trung,Xã Nghĩa Bình,Xã Đăng Hà,Xã Phước Sơn",
            "Huyện Chơn Thành" => "Thị trấn Chơn Thành,Xã Thành Tâm,Xã Minh Lập,Xã Quang Minh,Xã Minh Hưng,Xã Minh Long,Xã Minh Thành,Xã Nha Bích,Xã Minh Thắng",
            "Huyện Phú Riềng" => "Xã Long Bình,Xã Bình Tân,Xã Bình Sơn,Xã Long Hưng,Xã Phước Tân,Xã Bù Nho,Xã Long Hà,Xã Long Tân,Xã Phú Trung,Xã Phú Riềng",
        ],
        "Tỉnh Tây Ninh" => [
            "Thành phố Tây Ninh" => "Phường 1,Phường 3,Phường 4,Phường Hiệp Ninh,Phường 2,Xã Thạnh Tân,Xã Tân Bình,Xã Bình Minh,Phường Ninh Sơn,Phường Ninh Thạnh",
            "Huyện Tân Biên" => "Thị trấn Tân Biên,Xã Tân Lập,Xã Thạnh Bắc,Xã Tân Bình,Xã Thạnh Bình,Xã Thạnh Tây,Xã Hòa Hiệp,Xã Tân Phong,Xã Mỏ Công,Xã Trà Vong",
            "Huyện Tân Châu" => "Thị trấn Tân Châu,Xã Tân Hà,Xã Tân Đông,Xã Tân Hội,Xã Tân Hòa,Xã Suối Ngô,Xã Suối Dây,Xã Tân Hiệp,Xã Thạnh Đông,Xã Tân Thành,Xã Tân Phú,Xã Tân Hưng",
            "Huyện Dương Minh Châu" => "Thị trấn Dương Minh Châu,Xã Suối Đá,Xã Phan,Xã Phước Ninh,Xã Phước Minh,Xã Bàu Năng,Xã Chà Là,Xã Cầu Khởi,Xã Bến Củi,Xã Lộc Ninh,Xã Truông Mít",
            "Huyện Châu Thành" => "Thị trấn Châu Thành,Xã Hảo Đước,Xã Phước Vinh,Xã Đồng Khởi,Xã Thái Bình,Xã An Cơ,Xã Biên Giới,Xã Hòa Thạnh,Xã Trí Bình,Xã Hòa Hội,Xã An Bình,Xã Thanh Điền,Xã Thành Long,Xã Ninh Điền,Xã Long Vĩnh",
            "Thị xã Hòa Thành" => "Phường Long Hoa,Phường Hiệp Tân,Phường Long Thành Bắc,Xã Trường Hòa,Xã Trường Đông,Phường Long Thành Trung,Xã Trường Tây,Xã Long Thành Nam",
            "Huyện Gò Dầu" => "Thị trấn Gò Dầu,Xã Thạnh Đức,Xã Cẩm Giang,Xã Hiệp Thạnh,Xã Bàu Đồn,Xã Phước Thạnh,Xã Phước Đông,Xã Phước Trạch,Xã Thanh Phước",
            "Huyện Bến Cầu" => "Thị trấn Bến Cầu,Xã Long Chữ,Xã Long Phước,Xã Long Giang,Xã Tiên Thuận,Xã Long Khánh,Xã Lợi Thuận,Xã Long Thuận,Xã An Thạnh",
            "Thị xã Trảng Bàng" => "Phường Trảng Bàng,Xã Đôn Thuận,Xã Hưng Thuận,Phường Lộc Hưng,Phường Gia Lộc,Phường Gia Bình,Xã Phước Bình,Phường An Tịnh,Phường An Hòa,Xã Phước Chỉ",
        ],
        "Tỉnh Bình Dương" => [
            "Thành phố Thủ Dầu Một" => "Phường Hiệp Thành,Phường Phú Lợi,Phường Phú Cường,Phường Phú Hòa,Phường Phú Thọ,Phường Chánh Nghĩa,Phường Định Hoà,Phường Hoà Phú,Phường Phú Mỹ,Phường Phú Tân,Phường Tân An,Phường Hiệp An,Phường Tương Bình Hiệp,Phường Chánh Mỹ",
            "Huyện Bàu Bàng" => "Xã Trừ Văn Thố,Xã Cây Trường II,Thị trấn Lai Uyên,Xã Tân Hưng,Xã Long Nguyên,Xã Hưng Hòa,Xã Lai Hưng",
            "Huyện Dầu Tiếng" => "Thị trấn Dầu Tiếng,Xã Minh Hoà,Xã Minh Thạnh,Xã Minh Tân,Xã Định An,Xã Long Hoà,Xã Định Thành,Xã Định Hiệp,Xã An Lập,Xã Long Tân,Xã Thanh An,Xã Thanh Tuyền",
            "Thị xã Bến Cát" => "Phường Mỹ Phước,Phường Chánh Phú Hòa,Xã An Điền,Xã An Tây,Phường Thới Hòa,Phường Hòa Lợi,Phường Tân Định,Xã Phú An",
            "Huyện Phú Giáo" => "Thị trấn Phước Vĩnh,Xã An Linh,Xã Phước Sang,Xã An Thái,Xã An Long,Xã An Bình,Xã Tân Hiệp,Xã Tam Lập,Xã Tân Long,Xã Vĩnh Hoà,Xã Phước Hoà",
            "Thị xã Tân Uyên" => "Phường Uyên Hưng,Phường Tân Phước Khánh,Phường Vĩnh Tân,Phường Hội Nghĩa,Phường Tân Hiệp,Phường Khánh Bình,Phường Phú Chánh,Xã Bạch Đằng,Phường Tân Vĩnh Hiệp,Phường Thạnh Phước,Xã Thạnh Hội,Phường Thái Hòa",
            "Thành phố Dĩ An" => "Phường Dĩ An,Phường Tân Bình,Phường Tân Đông Hiệp,Phường Bình An,Phường Bình Thắng,Phường Đông Hòa,Phường An Bình",
            "Thành phố Thuận An" => "Phường An Thạnh,Phường Lái Thiêu,Phường Bình Chuẩn,Phường Thuận Giao,Phường An Phú,Phường Hưng Định,Xã An Sơn,Phường Bình Nhâm,Phường Bình Hòa,Phường Vĩnh Phú",
            "Huyện Bắc Tân Uyên" => "Xã Tân Định,Xã Bình Mỹ,Thị trấn Tân Bình,Xã Tân Lập,Thị trấn Tân Thành,Xã Đất Cuốc,Xã Hiếu Liêm,Xã Lạc An,Xã Tân Mỹ,Xã Thường Tân",
        ],
        "Tỉnh Đồng Nai" => [
            "Thành phố Biên Hòa" => "Phường Trảng Dài,Phường Tân Phong,Phường Tân Biên,Phường Hố Nai,Phường Tân Hòa,Phường Tân Hiệp,Phường Bửu Long,Phường Tân Tiến,Phường Tam Hiệp,Phường Long Bình,Phường Quang Vinh,Phường Tân Mai,Phường Thống Nhất,Phường Trung Dũng,Phường Tam Hòa,Phường Hòa Bình,Phường Quyết Thắng,Phường Thanh Bình,Phường Bình Đa,Phường An Bình,Phường Bửu Hòa,Phường Long Bình Tân,Phường Tân Vạn,Phường Tân Hạnh,Phường Hiệp Hòa,Phường Hóa An,Phường An Hòa,Phường Tam Phước,Phường Phước Tân,Xã Long Hưng",
            "Thành phố Long Khánh" => "Phường Xuân Trung,Phường Xuân Thanh,Phường Xuân Bình,Phường Xuân An,Phường Xuân Hoà,Phường Phú Bình,Xã Bình Lộc,Xã Bảo Quang,Phường Suối Tre,Phường Bảo Vinh,Phường Xuân Lập,Phường Bàu Sen,Xã Bàu Trâm,Phường Xuân Tân,Xã Hàng Gòn",
            "Huyện Tân Phú" => "Thị trấn Tân Phú,Xã Dak Lua,Xã Nam Cát Tiên,Xã Phú An,Xã Núi Tượng,Xã Tà Lài,Xã Phú Lập,Xã Phú Sơn,Xã Phú Thịnh,Xã Thanh Sơn,Xã Phú Trung,Xã Phú Xuân,Xã Phú Lộc,Xã Phú Lâm,Xã Phú Bình,Xã Phú Thanh,Xã Trà Cổ,Xã Phú Điền",
            "Huyện Vĩnh Cửu" => "Thị trấn Vĩnh An,Xã Phú Lý,Xã Trị An,Xã Tân An,Xã Vĩnh Tân,Xã Bình Lợi,Xã Thạnh Phú,Xã Thiện Tân,Xã Tân Bình,Xã Bình Hòa,Xã Mã Đà,Xã Hiếu Liêm",
            "Huyện Định Quán" => "Thị trấn Định Quán,Xã Thanh Sơn,Xã Phú Tân,Xã Phú Vinh,Xã Phú Lợi,Xã Phú Hòa,Xã Ngọc Định,Xã La Ngà,Xã Gia Canh,Xã Phú Ngọc,Xã Phú Cường,Xã Túc Trưng,Xã Phú Túc,Xã Suối Nho",
            "Huyện Trảng Bom" => "Thị trấn Trảng Bom,Xã Thanh Bình,Xã Cây Gáo,Xã Bàu Hàm,Xã Sông Thao,Xã Sông Trầu,Xã Đông Hoà,Xã Bắc Sơn,Xã Hố Nai 3,Xã Tây Hoà,Xã Bình Minh,Xã Trung Hoà,Xã Đồi 61,Xã Hưng Thịnh,Xã Quảng Tiến,Xã Giang Điền,Xã An Viễn",
            "Huyện Thống Nhất" => "Xã Gia Tân 1,Xã Gia Tân 2,Xã Gia Tân 3,Xã Gia Kiệm,Xã Quang Trung,Xã Bàu Hàm 2,Xã Hưng Lộc,Xã Lộ 25,Xã Xuân Thiện,Thị trấn Dầu Giây",
            "Huyện Cẩm Mỹ" => "Xã Sông Nhạn,Xã Xuân Quế,Xã Nhân Nghĩa,Xã Xuân Đường,Thị trấn Long Giao,Xã Xuân Mỹ,Xã Thừa Đức,Xã Bảo Bình,Xã Xuân Bảo,Xã Xuân Tây,Xã Xuân Đông,Xã Sông Ray,Xã Lâm San",
            "Huyện Long Thành" => "Thị trấn Long Thành,Xã An Phước,Xã Bình An,Xã Long Đức,Xã Lộc An,Xã Bình Sơn,Xã Tam An,Xã Cẩm Đường,Xã Long An,Xã Bàu Cạn,Xã Long Phước,Xã Phước Bình,Xã Tân Hiệp,Xã Phước Thái",
            "Huyện Xuân Lộc" => "Thị trấn Gia Ray,Xã Xuân Bắc,Xã Suối Cao,Xã Xuân Thành,Xã Xuân Thọ,Xã Xuân Trường,Xã Xuân Hòa,Xã Xuân Hưng,Xã Xuân Tâm,Xã Suối Cát,Xã Xuân Hiệp,Xã Xuân Phú,Xã Xuân Định,Xã Bảo Hoà,Xã Lang Minh",
            "Huyện Nhơn Trạch" => "Xã Phước Thiền,Xã Long Tân,Xã Đại Phước,Thị trấn Hiệp Phước,Xã Phú Hữu,Xã Phú Hội,Xã Phú Thạnh,Xã Phú Đông,Xã Long Thọ,Xã Vĩnh Thanh,Xã Phước Khánh,Xã Phước An",
        ],
        'Tỉnh Bà Rịa - Vũng Tàu' => [
            "Thành phố Vũng Tàu" => "Phường 1,Phường Thắng Tam,Phường 2,Phường 3,Phường 4,Phường 5,Phường Thắng Nhì,Phường 7,Phường Nguyễn An Ninh,Phường 8,Phường 9,Phường Thắng Nhất,Phường Rạch Dừa,Phường 10,Phường 11,Phường 12,Xã Long Sơn",
            "Thành phố Bà Rịa" => "Phường Phước Hưng,Phường Phước Hiệp,Phường Phước Nguyên,Phường Long Toàn,Phường Long Tâm,Phường Phước Trung,Phường Long Hương,Phường Kim Dinh,Xã Tân Hưng,Xã Long Phước,Xã Hoà Long",
            "Huyện Châu Đức" => "Xã Bàu Chinh,Thị trấn Ngãi Giao,Xã Bình Ba,Xã Suối Nghệ,Xã Xuân Sơn,Xã Sơn Bình,Xã Bình Giã,Xã Bình Trung,Xã Xà Bang,Xã Cù Bị,Xã Láng Lớn,Xã Quảng Thành,Xã Kim Long,Xã Suối Rao,Xã Đá Bạc,Xã Nghĩa Thành",
            "Huyện Xuyên Mộc" => "Thị trấn Phước Bửu,Xã Phước Thuận,Xã Phước Tân,Xã Xuyên Mộc,Xã Bông Trang,Xã Tân Lâm,Xã Bàu Lâm,Xã Hòa Bình,Xã Hòa Hưng,Xã Hòa Hiệp,Xã Hòa Hội,Xã Bưng Riềng,Xã Bình Châu",
            "Huyện Long Điền" => "Thị trấn Long Điền,Thị trấn Long Hải,Xã An Ngãi,Xã Tam Phước,Xã An Nhứt,Xã Phước Tỉnh,Xã Phước Hưng",
            "Huyện Đất Đỏ" => "Thị trấn Đất Đỏ,Xã Phước Long Thọ,Xã Phước Hội,Xã Long Mỹ,Thị trấn Phước Hải,Xã Long Tân,Xã Láng Dài,Xã Lộc An",
            "Thị xã Phú Mỹ" => "Phường Phú Mỹ,Xã Tân Hoà,Xã Tân Hải,Phường Phước Hoà,Phường Tân Phước,Phường Mỹ Xuân,Xã Sông Xoài,Phường Hắc Dịch,Xã Châu Pha,Xã Tóc Tiên",
            "Huyện Côn Đảo" => null,
        ],
        'Thành phố Hồ Chí Minh' => [
            "Quận 1" => "Phường Tân Định,Phường Đa Kao,Phường Bến Nghé,Phường Bến Thành,Phường Nguyễn Thái Bình,Phường Phạm Ngũ Lão,Phường Cầu Ông Lãnh,Phường Cô Giang,Phường Nguyễn Cư Trinh,Phường Cầu Kho",
            'Quận 12' => "Phường Thạnh Xuân,Phường Thạnh Lộc,Phường Hiệp Thành,Phường Thới An,Phường Tân Chánh Hiệp,Phường An Phú Đông,Phường Tân Thới Hiệp,Phường Trung Mỹ Tây,Phường Tân Hưng Thuận,Phường Đông Hưng Thuận,Phường Tân Thới Nhất",
            "Quận Gò Vấp" => "Phường 15,Phường 13,Phường 17,Phường 6,Phường 16,Phường 12,Phường 14,Phường 10,Phường 05,Phường 07,Phường 04,Phường 01,Phường 9,Phường 8,Phường 11,Phường 03",
            "Quận Bình Thạnh" => 'Phường 13,Phường 11,Phường 27,Phường 26,Phường 12,Phường 25,Phường 05,Phường 07,Phường 24,Phường 06,Phường 14,Phường 15,Phường 02,Phường 01,Phường 03,Phường 17,Phường 21,Phường 22,Phường 19,Phường 28',
            'Quận Tân Bình' => "Phường 02,Phường 04,Phường 12,Phường 13,Phường 01,Phường 03,Phường 11,Phường 07,Phường 05,Phường 10,Phường 06,Phường 08,Phường 09,Phường 14,Phường 15",
            "Quận Tân Phú" => "Phường Tân Sơn Nhì,Phường Tây Thạnh,Phường Sơn Kỳ,Phường Tân Quý,Phường Tân Thành,Phường Phú Thọ Hòa,Phường Phú Thạnh,Phường Phú Trung,Phường Hòa Thạnh,Phường Hiệp Tân,Phường Tân Thới Hòa",
            "Quận Phú Nhuận" => "Phường 04,Phường 05,Phường 09,Phường 07,Phường 03,Phường 01,Phường 02,Phường 08,Phường 15,Phường 10,Phường 11,Phường 17,Phường 13",
            "Thành phố Thủ Đức" => "Phường Linh Xuân,Phường Bình Chiểu,Phường Linh Trung,Phường Tam Bình,Phường Tam Phú,Phường Hiệp Bình Phước,Phường Hiệp Bình Chánh,Phường Linh Chiểu,Phường Linh Tây,Phường Linh Đông,Phường Bình Thọ,Phường Trường Thọ,Phường Long Bình,Phường Long Thạnh Mỹ,Phường Tân Phú,Phường Hiệp Phú,Phường Tăng Nhơn Phú A,Phường Tăng Nhơn Phú B,Phường Phước Long B,Phường Phước Long A,Phường Trường Thạnh,Phường Long Phước,Phường Long Trường,Phường Phước Bình,Phường Phú Hữu,Phường Thảo Điền,Phường An Phú,Phường An Khánh,Phường Bình Trưng Đông,Phường Bình Trưng Tây,Phường Cát Lái,Phường Thạnh Mỹ Lợi,Phường An Lợi Đông,Phường Thủ Thiêm",
            "Quận 3" => "Phường 14,Phường 12,Phường 11,Phường 13,Phường Võ Thị Sáu,Phường 09,Phường 10,Phường 04,Phường 05,Phường 03,Phường 02,Phường 01",
            "Quận 10" => "Phường 15,Phường 13,Phường 14,Phường 12,Phường 11,Phường 10,Phường 09,Phường 01,Phường 08,Phường 02,Phường 04,Phường 07,Phường 05,Phường 06",
            "Quận 11" => "Phường 15,Phường 05,Phường 14,Phường 11,Phường 03,Phường 10,Phường 13,Phường 08,Phường 09,Phường 12,Phường 07,Phường 06,Phường 04,Phường 01,Phường 02,Phường 16",
            "Quận 4" => "Phường 13,Phường 09,Phường 06,Phường 08,Phường 10,Phường 18,Phường 14,Phường 04,Phường 03,Phường 16,Phường 02,Phường 15,Phường 01",
            "Quận 5" => "Phường 04,Phường 09,Phường 03,Phường 12,Phường 02,Phường 08,Phường 07,Phường 01,Phường 11,Phường 14,Phường 05,Phường 06,Phường 10,Phường 13",
            "Quận 6" => "Phường 14,Phường 13,Phường 09,Phường 06,Phường 12,Phường 05,Phường 11,Phường 02,Phường 01,Phường 04,Phường 08,Phường 03,Phường 07,Phường 10",
            "Quận 8" => "Phường 08,Phường 02,Phường 01,Phường 03,Phường 11,Phường 09,Phường 10,Phường 04,Phường 13,Phường 12,Phường 05,Phường 14,Phường 06,Phường 15,Phường 16,Phường 07",
            "Quận Bình Tân" => "Phường Bình Hưng Hòa,Phường Bình Hưng Hoà A,Phường Bình Hưng Hoà B,Phường Bình Trị Đông,Phường Bình Trị Đông A,Phường Bình Trị Đông B,Phường Tân Tạo,Phường Tân Tạo A,Phường  An Lạc,Phường An Lạc A",
            "Quận 7" => "Phường Tân Thuận Đông,Phường Tân Thuận Tây,Phường Tân Kiểng,Phường Tân Hưng,Phường Bình Thuận,Phường Tân Quy,Phường Phú Thuận,Phường Tân Phú,Phường Tân Phong,Phường Phú Mỹ",
            "Huyện Củ Chi" => "Thị trấn Củ Chi,Xã Phú Mỹ Hưng,Xã An Phú,Xã Trung Lập Thượng,Xã An Nhơn Tây,Xã Nhuận Đức,Xã Phạm Văn Cội,Xã Phú Hòa Đông,Xã Trung Lập Hạ,Xã Trung An,Xã Phước Thạnh,Xã Phước Hiệp,Xã Tân An Hội,Xã Phước Vĩnh An,Xã Thái Mỹ,Xã Tân Thạnh Tây,Xã Hòa Phú,Xã Tân Thạnh Đông,Xã Bình Mỹ,Xã Tân Phú Trung,Xã Tân Thông Hội",
            "Huyện Hóc Môn" => "Thị trấn Hóc Môn,Xã Tân Hiệp,Xã Nhị Bình,Xã Đông Thạnh,Xã Tân Thới Nhì,Xã Thới Tam Thôn,Xã Xuân Thới Sơn,Xã Tân Xuân,Xã Xuân Thới Đông,Xã Trung Chánh,Xã Xuân Thới Thượng,Xã Bà Điểm",
            "Huyện Bình Chánh" => "Thị trấn Tân Túc,Xã Phạm Văn Hai,Xã Vĩnh Lộc A,Xã Vĩnh Lộc B,Xã Bình Lợi,Xã Lê Minh Xuân,Xã Tân Nhựt,Xã Tân Kiên,Xã Bình Hưng,Xã Phong Phú,Xã An Phú Tây,Xã Hưng Long,Xã Đa Phước,Xã Tân Quý Tây,Xã Bình Chánh,Xã Quy Đức",
            "Huyện Nhà Bè" => "Thị trấn Nhà Bè,Xã Phước Kiển,Xã Phước Lộc,Xã Nhơn Đức,Xã Phú Xuân,Xã Long Thới,Xã Hiệp Phước",
            "Huyện Cần Giờ" => "Thị trấn Cần Thạnh,Xã Bình Khánh,Xã Tam Thôn Hiệp,Xã An Thới Đông,Xã Thạnh An,Xã Long Hòa,Xã Lý Nhơn",
        ],
        "Tỉnh Long An" => [
            "Thành phố Tân An" => "Phường 5,Phường 2,Phường 4,Phường Tân Khánh,Phường 1,Phường 3,Phường 7,Phường 6,Xã Hướng Thọ Phú,Xã Nhơn Thạnh Trung,Xã Lợi Bình Nhơn,Xã Bình Tâm,Phường Khánh Hậu,Xã An Vĩnh Ngãi",
            "Thị xã Kiến Tường" => "Phường 1,Phường 2,Xã Thạnh Trị,Xã Bình Hiệp,Xã Bình Tân,Xã Tuyên Thạnh,Phường 3,Xã Thạnh Hưng",
            "Huyện Tân Hưng" => "Thị trấn Tân Hưng,Xã Hưng Hà,Xã Hưng Điền B,Xã Hưng Điền,Xã Thạnh Hưng,Xã Hưng Thạnh,Xã Vĩnh Thạnh,Xã Vĩnh Châu B,Xã Vĩnh Lợi,Xã Vĩnh Đại,Xã Vĩnh Châu A,Xã Vĩnh Bửu",
            "Huyện Vĩnh Hưng" => "Thị trấn Vĩnh Hưng,Xã Hưng Điền A,Xã Khánh Hưng,Xã Thái Trị,Xã Vĩnh Trị,Xã Thái Bình Trung,Xã Vĩnh Bình,Xã Vĩnh Thuận,Xã Tuyên Bình,Xã Tuyên Bình Tây",
            "Huyện Mộc Hóa" => "Xã Bình Hòa Tây,Xã Bình Thạnh,Xã Bình Hòa Trung,Xã Bình Hòa Đông,Thị trấn Bình Phong Thạnh,Xã Tân Lập,Xã Tân Thành",
            "Huyện Tân Thạnh" => "Thị trấn Tân Thạnh,Xã Bắc Hòa,Xã Hậu Thạnh Tây,Xã Nhơn Hòa Lập,Xã Tân Lập,Xã Hậu Thạnh Đông,Xã Nhơn Hoà,Xã Kiến Bình,Xã Tân Thành,Xã Tân Bình,Xã Tân Ninh,Xã Nhơn Ninh,Xã Tân Hòa",
            "Huyện Thạnh Hóa" => "Thị trấn Thạnh Hóa,Xã Tân Hiệp,Xã Thuận Bình,Xã Thạnh Phước,Xã Thạnh Phú,Xã Thuận Nghĩa Hòa,Xã Thủy Đông,Xã Thủy Tây,Xã Tân Tây,Xã Tân Đông,Xã Thạnh An",
            "Huyện Đức Huệ" => "Thị trấn Đông Thành,Xã Mỹ Quý Đông,Xã Mỹ Thạnh Bắc,Xã Mỹ Quý Tây,Xã Mỹ Thạnh Tây,Xã Mỹ Thạnh Đông,Xã Bình Thành,Xã Bình Hòa Bắc,Xã Bình Hòa Hưng,Xã Bình Hòa Nam,Xã Mỹ Bình",
            "Huyện Đức Hòa" => "Thị trấn Hậu Nghĩa,Thị trấn Hiệp Hòa,Thị trấn Đức Hòa,Xã Lộc Giang,Xã An Ninh Đông,Xã An Ninh Tây,Xã Tân Mỹ,Xã Hiệp Hòa,Xã Đức Lập Thượng,Xã Đức Lập Hạ,Xã Tân Phú,Xã Mỹ Hạnh Bắc,Xã Đức Hòa Thượng,Xã Hòa Khánh Tây,Xã Hòa Khánh Đông,Xã Mỹ Hạnh Nam,Xã Hòa Khánh Nam,Xã Đức Hòa Đông,Xã Đức Hòa Hạ,Xã Hựu Thạnh",
            "Huyện Bến Lức" => 'Thị trấn Bến Lức,Xã Thạnh Lợi,Xã Lương Bình,Xã Thạnh Hòa,Xã Lương Hòa,Xã Tân Hòa,Xã Tân Bửu,Xã An Thạnh,Xã Bình Đức,Xã Mỹ Yên,Xã Thanh Phú,Xã Long Hiệp,Xã Thạnh Đức,Xã Phước Lợi,Xã Nhựt Chánh',
            "Huyện Thủ Thừa" => "Thị trấn Thủ Thừa,Xã Long Thạnh,Xã Tân Thành,Xã Long Thuận,Xã Mỹ Lạc,Xã Mỹ Thạnh,Xã Bình An,Xã Nhị Thành,Xã Mỹ An,Xã Bình Thạnh,Xã Mỹ Phú,Xã Tân Long",
            "Huyện Tân Trụ" => "Thị trấn Tân Trụ,Xã Tân Bình,Xã Quê Mỹ Thạnh,Xã Lạc Tấn,Xã Bình Trinh Đông,Xã Tân Phước Tây,Xã Bình Lãng,Xã Bình Tịnh,Xã Đức Tân,Xã Nhựt Ninh",
            "Huyện Cần Đước" => "Thị trấn Cần Đước,Xã Long Trạch,Xã Long Khê,Xã Long Định,Xã Phước Vân,Xã Long Hòa,Xã Long Cang,Xã Long Sơn,Xã Tân Trạch,Xã Mỹ Lệ,Xã Tân Lân,Xã Phước Tuy,Xã Long Hựu Đông,Xã Tân Ân,Xã Phước Đông,Xã Long Hựu Tây,Xã Tân Chánh",
            "Huyện Cần Giuộc" => "Xã Phước Lý,Xã Long Thượng,Xã Long Hậu,Xã Phước Hậu,Xã Mỹ Lộc,Xã Phước Lại,Xã Phước Lâm,Xã Thuận Thành,Xã Phước Vĩnh Tây,Xã Phước Vĩnh Đông,Xã Long An,Xã Long Phụng,Xã Đông Thạnh,Xã Tân Tập",
            "Huyện Châu Thành" => 'Thị trấn Tầm Vu,Xã Bình Quới,Xã Hòa Phú,Xã Phú Ngãi Trị,Xã Vĩnh Công,Xã Thuận Mỹ,Xã Hiệp Thạnh,Xã Phước Tân Hưng,Xã Thanh Phú Long,Xã Dương Xuân Hội,Xã An Lục Long,Xã Long Trì,Xã Thanh Vĩnh Đông',
        ],
        'Tỉnh Tiền Giang' => [
            'Thành phố Mỹ Tho' => 'Phường 5,Phường 4,Phường 7,Phường 3,Phường 1,Phường 2,Phường 8,Phường 6,Phường 9,Phường 10,Phường Tân Long,Xã Đạo Thạnh,Xã Trung An,Xã Mỹ Phong,Xã Tân Mỹ Chánh,Xã Phước Thạnh,Xã Thới Sơn',
            'Thị xã Gò Công' => 'Phường 3,Phường 2,Phường 4,Phường 1,Phường 5,Xã Long Hưng,Xã Long Thuận,Xã Long Chánh,Xã Long Hòa,Xã Bình Đông,Xã Bình Xuân,Xã Tân Trung',
            'Thị xã Cai Lậy' => 'Phường 1,Phường 2,Phường 3,Phường 4,Phường 5,Xã Mỹ Phước Tây,Xã Mỹ Hạnh Đông,Xã Mỹ Hạnh Trung,Xã Tân Phú,Xã Tân Bình,Xã Tân Hội,Phường Nhị Mỹ,Xã Nhị Quý,Xã Thanh Hòa,Xã Phú Quý,Xã Long Khánh',
            'Huyện Tân Phước' => 'Thị trấn Mỹ Phước,Xã Tân Hòa Đông,Xã Thạnh Tân,Xã Thạnh Mỹ,Xã Thạnh Hoà,Xã Phú Mỹ,Xã Tân Hòa Thành,Xã Hưng Thạnh,Xã Tân Lập 1,Xã Tân Hòa Tây,Xã Tân Lập 2,Xã Phước Lập',
            'Huyện Cái Bè' => 'Thị trấn Cái Bè,Xã Hậu Mỹ Bắc B,Xã Hậu Mỹ Bắc A,Xã Mỹ Trung,Xã Hậu Mỹ Trinh,Xã Hậu Mỹ Phú,Xã Mỹ Tân,Xã Mỹ Lợi B,Xã Thiện Trung,Xã Mỹ Hội,Xã An Cư,Xã Hậu Thành,Xã Mỹ Lợi A,Xã Hòa Khánh,Xã Thiện Trí,Xã Mỹ Đức Đông,Xã Mỹ Đức Tây,Xã Đông Hòa Hiệp,Xã An Thái Đông,Xã Tân Hưng,Xã Mỹ Lương,Xã Tân Thanh,Xã An Thái Trung,Xã An Hữu,Xã Hòa Hưng',
            'Huyện Cai Lậy' => 'Xã Thạnh Lộc,Xã Mỹ Thành Bắc,Xã Phú Cường,Xã Mỹ Thành Nam,Xã Phú Nhuận,Xã Bình Phú,Xã Cẩm Sơn,Xã Phú An,Xã Mỹ Long,Xã Long Tiên,Xã Hiệp Đức,Xã Long Trung,Xã Hội Xuân,Xã Tân Phong,Xã Tam Bình,Xã Ngũ Hiệp',
            'Huyện Châu Thành' => 'Thị trấn Tân Hiệp,Xã Tân Hội Đông,Xã Tân Hương,Xã Tân Lý Đông,Xã Tân Lý Tây,Xã Thân Cửu Nghĩa,Xã Tam Hiệp,Xã Điềm Hy,Xã Nhị Bình,Xã Dưỡng Điềm,Xã Đông Hòa,Xã Long Định,Xã Hữu Đạo,Xã Long An,Xã Long Hưng,Xã Bình Trưng,Xã Thạnh Phú,Xã Bàn Long,Xã Vĩnh Kim,Xã Bình Đức,Xã Song Thuận,Xã Kim Sơn,Xã Phú Phong',
            'Huyện Chợ Gạo' => 'Thị trấn Chợ Gạo,Xã Trung Hòa,Xã Hòa Tịnh,Xã Mỹ Tịnh An,Xã Tân Bình Thạnh,Xã Phú Kiết,Xã Lương Hòa Lạc,Xã Thanh Bình,Xã Quơn Long,Xã Bình Phục Nhứt,Xã Đăng Hưng Phước,Xã Tân Thuận Bình,Xã Song Bình,Xã Bình Phan,Xã Long Bình Điền,Xã An Thạnh Thủy,Xã Xuân Đông,Xã Hòa Định,Xã Bình Ninh',
            'Huyện Gò Công Tây' => 'Thị trấn Vĩnh Bình,Xã Đồng Sơn,Xã Bình Phú,Xã Đồng Thạnh,Xã Thành Công,Xã Bình Nhì,Xã Yên Luông,Xã Thạnh Trị,Xã Thạnh Nhựt,Xã Long Vĩnh,Xã Bình Tân,Xã Vĩnh Hựu,Xã Long Bình',
            'Huyện Gò Công Đông' => 'Thị trấn Tân Hòa,Xã Tăng Hoà,Xã Tân Phước,Xã Gia Thuận,Thị trấn Vàm Láng,Xã Tân Tây,Xã Kiểng Phước,Xã Tân Đông,Xã Bình Ân,Xã Tân Điền,Xã Bình Nghị,Xã Phước Trung,Xã Tân Thành',
            'Huyện Tân Phú Đông' => 'Xã Tân Thới,Xã Tân Phú,Xã Phú Thạnh,Xã Tân Thạnh,Xã Phú Đông,Xã Phú Tân',
        ],
        'Tỉnh Bến Tre' => [
            'Thành phố Bến Tre' => 'Phường Phú Khương,Phường Phú Tân,Phường 8,Phường 6,Phường 4,Phường 5,Phường An Hội,Phường 7,Xã Sơn Đông,Xã Phú Hưng,Xã Bình Phú,Xã Mỹ Thạnh An,Xã Nhơn Thạnh,Xã Phú Nhuận',
            'Huyện Châu Thành' => 'Thị trấn Châu Thành,Xã Tân Thạch,Xã Qưới Sơn,Xã An Khánh,Xã Giao Long,Xã Phú Túc,Xã Phú Đức,Xã Phú An Hòa,Xã An Phước,Xã Tam Phước,Xã Thành Triệu,Xã Tường Đa,Xã Tân Phú,Xã Quới Thành,Xã Phước Thạnh,Xã An Hóa,Xã Tiên Long,Xã An Hiệp,Xã Hữu Định,Xã Tiên Thủy,Xã Sơn Hòa',
            'Huyện Chợ Lách' => 'Thị trấn Chợ Lách,Xã Phú Phụng,Xã Sơn Định,Xã Vĩnh Bình,Xã Hòa Nghĩa,Xã Long Thới,Xã Phú Sơn,Xã Tân Thiềng,Xã Vĩnh Thành,Xã Vĩnh Hòa,Xã Hưng Khánh Trung B',
            'Huyện Mỏ Cày Nam' => 'Thị trấn Mỏ Cày,Xã Định Thủy,Xã Đa Phước Hội,Xã Tân Hội,Xã Phước Hiệp,Xã Bình Khánh ,Xã An Thạnh,Xã An Định,Xã Thành Thới B,Xã Tân Trung,Xã An Thới,Xã Thành Thới A,Xã Minh Đức,Xã Ngãi Đăng,Xã Cẩm Sơn,Xã Hương Mỹ',
            'Huyện Giồng Trôm' => 'Thị trấn Giồng Trôm,Xã Phong Nẫm,Xã Mỹ Thạnh,Xã Châu Hòa,Xã Lương Hòa,Xã Lương Quới,Xã Lương Phú,Xã Châu Bình,Xã Thuận Điền,Xã Sơn Phú,Xã Bình Hoà,Xã Phước Long,Xã Hưng Phong,Xã Long Mỹ,Xã Tân Hào,Xã Bình Thành,Xã Tân Thanh,Xã Tân Lợi Thạnh,Xã Thạnh Phú Đông,Xã Hưng Nhượng,Xã Hưng Lễ',
            'Huyện Bình Đại' => 'Thị trấn Bình Đại,Xã Tam Hiệp,Xã Long Định,Xã Long Hòa,Xã Phú Thuận,Xã Vang Quới Tây,Xã Vang Quới Đông,Xã Châu Hưng,Xã Phú Vang,Xã Lộc Thuận,Xã Định Trung,Xã Thới Lai,Xã Bình Thới,Xã Phú Long,Xã Bình Thắng,Xã Thạnh Trị,Xã Đại Hòa Lộc,Xã Thừa Đức,Xã Thạnh Phước,Xã Thới Thuận',
            'Huyện Ba Tri' => 'Thị trấn Ba Tri,Xã Tân Mỹ,Xã Mỹ Hòa,Xã Tân Xuân,Xã Mỹ Chánh,Xã Bảo Thạnh,Xã An Phú Trung,Xã Mỹ Thạnh,Xã Mỹ Nhơn,Xã Phước Ngãi,Xã An Ngãi Trung,Xã Phú Lễ,Xã An Bình Tây,Xã Bảo Thuận,Xã Tân Hưng,Xã An Ngãi Tây,Xã An Hiệp,Xã Vĩnh Hòa,Xã Tân Thủy,Xã Vĩnh An,Xã An Đức,Xã An Hòa Tây,Xã An Thủy',
            'Huyện Thạnh Phú' => 'Thị trấn Thạnh Phú,Xã Phú Khánh,Xã Đại Điền,Xã Quới Điền,Xã Tân Phong,Xã Mỹ Hưng,Xã An Thạnh,Xã Thới Thạnh,Xã Hòa Lợi,Xã An Điền,Xã Bình Thạnh,Xã An Thuận,Xã An Quy,Xã Thạnh Hải,Xã An Nhơn,Xã Giao Thạnh,Xã Thạnh Phong,Xã Mỹ An',
            'Huyện Mỏ Cày Bắc' => 'Xã Phú Mỹ,Xã Hưng Khánh Trung A,Xã Thanh Tân,Xã Thạnh Ngãi,Xã Tân Phú Tây,Xã Phước Mỹ Trung,Xã Tân Thành Bình,Xã Thành An,Xã Hòa Lộc,Xã Tân Thanh Tây,Xã Tân Bình,Xã Nhuận Phú Tân,Xã Khánh Thạnh Tân',
        ],
        'Tỉnh Trà Vinh' => [
            'Thành phố Trà Vinh' => 'Phường 4,Phường 1,Phường 3,Phường 2,Phường 5,Phường 6,Phường 7,Phường 8,Phường 9,Xã Long Đức',
            'Huyện Càng Long' => 'Thị trấn Càng Long,Xã Mỹ Cẩm,Xã An Trường A,Xã An Trường,Xã Huyền Hội,Xã Tân An,Xã Tân Bình,Xã Bình Phú,Xã Phương Thạnh,Xã Đại Phúc,Xã Đại Phước,Xã Nhị Long Phú,Xã Nhị Long,Xã Đức Mỹ',
            'Huyện Cầu Kè' => 'Thị trấn Cầu Kè,Xã Hòa Ân,Xã Châu Điền,Xã An Phú Tân,Xã Hoà Tân,Xã Ninh Thới,Xã Phong Phú,Xã Phong Thạnh,Xã Tam Ngãi,Xã Thông Hòa,Xã Thạnh Phú',
            'Huyện Tiểu Cần' => 'Thị trấn Tiểu Cần,Thị trấn Cầu Quan,Xã Phú Cần,Xã Hiếu Tử,Xã Hiếu Trung,Xã Long Thới,Xã Hùng Hòa,Xã Tân Hùng,Xã Tập Ngãi,Xã Ngãi Hùng,Xã Tân Hòa',
            'Huyện Châu Thành' => 'Thị trấn Châu Thành,Xã Đa Lộc,Xã Mỹ Chánh,Xã Thanh Mỹ,Xã Lương Hoà A,Xã Lương Hòa,Xã Song Lộc,Xã Nguyệt Hóa,Xã Hòa Thuận,Xã Hòa Lợi,Xã Phước Hảo,Xã Hưng Mỹ,Xã Hòa Minh,Xã Long Hòa',
            'Huyện Cầu Ngang' => 'Thị trấn Cầu Ngang,Thị trấn Mỹ Long,Xã Mỹ Long Bắc,Xã Mỹ Long Nam,Xã Mỹ Hòa,Xã Vĩnh Kim,Xã Kim Hòa,Xã Hiệp Hòa,Xã Thuận Hòa,Xã Long Sơn,Xã Nhị Trường,Xã Trường Thọ,Xã Hiệp Mỹ Đông,Xã Hiệp Mỹ Tây,Xã Thạnh Hòa Sơn',
            'Huyện Trà Cú' => 'Thị trấn Trà Cú,Thị trấn Định An,Xã Phước Hưng,Xã Tập Sơn,Xã Tân Sơn,Xã An Quảng Hữu,Xã Lưu Nghiệp Anh,Xã Ngãi Xuyên,Xã Kim Sơn,Xã Thanh Sơn,Xã Hàm Giang,Xã Hàm Tân,Xã Đại An,Xã Định An,Xã Ngọc Biên,Xã Long Hiệp,Xã Tân Hiệp',
            'Huyện Duyên Hải' => 'Xã Đôn Xuân,Xã Đôn Châu,Thị trấn Long Thành,Xã Long Khánh,Xã Ngũ Lạc,Xã Long Vĩnh,Xã Đông Hải',
            'Thị xã Duyên Hải' => 'Phường 1,Xã Long Toàn,Phường 2,Xã Long Hữu,Xã Dân Thành,Xã Trường Long Hòa,Xã Hiệp Thạnh',
        ],
        'Tỉnh Vĩnh Long' => [
            'Thành phố Vĩnh Long' => 'Phường 9,Phường 5,Phường 1,Phường 2,Phường 4,Phường 3,Phường 8,Phường Tân Ngãi,Phường Tân Hòa,Phường Tân Hội,Phường Trường An',
            'Huyện Long Hồ' => 'Thị trấn Long Hồ,Xã Đồng Phú,Xã Bình Hòa Phước,Xã Hòa Ninh,Xã An Bình,Xã Thanh Đức,Xã Tân Hạnh,Xã Phước Hậu,Xã Long Phước,Xã Phú Đức,Xã Lộc Hòa,Xã Long An,Xã Phú Quới,Xã Thạnh Quới,Xã Hòa Phú',
            'Huyện Mang Thít' => 'Xã Mỹ An,Xã Mỹ Phước,Xã An Phước,Xã Nhơn Phú,Xã Long Mỹ,Xã Hòa Tịnh,Thị trấn Cái Nhum,Xã Bình Phước,Xã Chánh An,Xã Tân An Hội,Xã Tân Long,Xã Tân Long Hội',
            'Huyện  Vũng Liêm' => 'Thị trấn Vũng Liêm,Xã Tân Quới Trung,Xã Quới Thiện,Xã Quới An,Xã Trung Chánh,Xã Tân An Luông,Xã Thanh Bình,Xã Trung Thành Tây,Xã Trung Hiệp,Xã Hiếu Phụng,Xã Trung Thành Đông,Xã Trung Thành,Xã Trung Hiếu,Xã Trung Ngãi,Xã Hiếu Thuận,Xã Trung Nghĩa,Xã Trung An,Xã Hiếu Nhơn,Xã Hiếu Thành,Xã Hiếu Nghĩa',
            'Huyện Tam Bình' => 'Thị trấn Tam Bình,Xã Tân Lộc,Xã Phú Thịnh,Xã Hậu Lộc,Xã Hòa Thạnh,Xã Hoà Lộc,Xã Phú Lộc,Xã Song Phú,Xã Hòa Hiệp,Xã Mỹ Lộc,Xã Tân Phú,Xã Long Phú,Xã Mỹ Thạnh Trung,Xã Tường Lộc,Xã Loan Mỹ,Xã Ngãi Tứ,Xã Bình Ninh',
            'Thị xã Bình Minh' => 'Phường Cái Vồn,Phường Thành Phước,Xã Thuận An,Xã Đông Thạnh,Xã Đông Bình,Phường Đông Thuận,Xã Mỹ Hòa,Xã Đông Thành',
            'Huyện Trà Ôn' => 'Thị trấn Trà Ôn,Xã Xuân Hiệp,Xã Nhơn Bình,Xã Hòa Bình,Xã Thới Hòa,Xã Trà Côn,Xã Tân Mỹ,Xã Hựu Thành,Xã Vĩnh Xuân,Xã Thuận Thới,Xã Phú Thành,Xã Thiện Mỹ,Xã Lục Sỹ Thành,Xã Tích Thiện',
            'Huyện Bình Tân' => 'Xã Tân Hưng,Xã Tân Thành,Xã Thành Trung,Xã Tân An Thạnh,Xã Tân Lược,Xã Nguyễn Văn Thảnh,Xã Thành Lợi,Xã Mỹ Thuận,Xã Tân Bình,Thị trấn Tân Quới',
        ],
        'Tỉnh Đồng Tháp' => [
            'Thành phố Cao Lãnh' => 'Phường 11,Phường 1,Phường 2,Phường 4,Phường 3,Phường 6,Xã Mỹ Ngãi,Xã Mỹ Tân,Xã Mỹ Trà,Phường Mỹ Phú,Xã Tân Thuận Tây,Phường Hoà Thuận,Xã Hòa An,Xã Tân Thuận Đông,Xã Tịnh Thới',
            'Thành phố Sa Đéc' => 'Phường 3,Phường 1,Phường 4,Phường 2,Xã Tân Khánh Đông,Phường Tân Quy Đông,Phường An Hoà,Xã Tân Quy Tây,Xã Tân Phú Đông',
            'Thành phố Hồng Ngự' => 'Phường An Lộc,Phường An Thạnh,Xã Bình Thạnh,Xã Tân Hội,Phường An Lạc,Phường An Bình B,Phường An Bình A',
            'Huyện Tân Hồng' => 'Thị trấn Sa Rài,Xã Tân Hộ Cơ,Xã Thông Bình,Xã Bình Phú,Xã Tân Thành A,Xã Tân Thành B,Xã Tân Phước,Xã Tân Công Chí,Xã An Phước',
            'Huyện Hồng Ngự' => 'Xã Thường Phước 1,Xã Thường Thới Hậu A,Thị trấn Thường Thới Tiền,Xã Thường Phước 2,Xã Thường Lạc,Xã Long Khánh A,Xã Long Khánh B,Xã Long Thuận,Xã Phú Thuận B,Xã Phú Thuận A',
            'Huyện Tam Nông' => 'Thị trấn Tràm Chim,Xã Hoà Bình,Xã Tân Công Sính,Xã Phú Hiệp,Xã Phú Đức,Xã Phú Thành B,Xã An Hòa,Xã An Long,Xã Phú Cường,Xã Phú Ninh,Xã Phú Thọ,Xã Phú Thành A',
            'Huyện Tháp Mười' => 'Thị trấn Mỹ An,Xã Thạnh Lợi,Xã Hưng Thạnh,Xã Trường Xuân,Xã Tân Kiều,Xã Mỹ Hòa,Xã Mỹ Quý,Xã Mỹ Đông,Xã Đốc Binh Kiều,Xã Mỹ An,Xã Phú Điền,Xã Láng Biển,Xã Thanh Mỹ',
            'Huyện Cao Lãnh' => 'Thị trấn Mỹ Thọ,Xã Gáo Giồng,Xã Phương Thịnh,Xã Ba Sao,Xã Phong Mỹ,Xã Tân Nghĩa,Xã Phương Trà,Xã Nhị Mỹ,Xã Mỹ Thọ,Xã Tân Hội Trung,Xã An Bình,Xã Mỹ Hội,Xã Mỹ Hiệp,Xã Mỹ Long,Xã Bình Hàng Trung,Xã Mỹ Xương,Xã Bình Hàng Tây,Xã Bình Thạnh',
            'Huyện Thanh Bình' => 'Thị trấn Thanh Bình,Xã Tân Quới,Xã Tân Hòa,Xã An Phong,Xã Phú Lợi,Xã Tân Mỹ,Xã Bình Tấn,Xã Tân Huề,Xã Tân Bình,Xã Tân Thạnh,Xã Tân Phú,Xã Bình Thành,Xã Tân Long',
            'Huyện Lấp Vò' => 'Thị trấn Lấp Vò,Xã Mỹ An Hưng A,Xã Tân Mỹ,Xã Mỹ An Hưng B,Xã Tân  Khánh Trung,Xã Long Hưng A,Xã Vĩnh Thạnh,Xã Long Hưng B,Xã Bình Thành,Xã Định An,Xã Định Yên,Xã Hội An Đông,Xã Bình Thạnh Trung',
            'Huyện Lai Vung' => 'Thị trấn Lai Vung,Xã Tân Dương,Xã Hòa Thành,Xã Long Hậu,Xã Tân Phước,Xã Hòa Long,Xã Tân Thành,Xã Long Thắng,Xã Vĩnh Thới,Xã Tân Hòa,Xã Định Hòa,Xã Phong Hòa',
            'Huyện Châu Thành' => 'Thị trấn Cái Tàu Hạ,Xã An Hiệp,Xã An Nhơn,Xã Tân Nhuận Đông,Xã Tân Bình,Xã Tân Phú Trung,Xã Phú Long,Xã An Phú Thuận,Xã Phú Hựu,Xã An Khánh,Xã Tân Phú,Xã Hòa Tân',
        ],
        'Tỉnh An Giang' => [
            'Thành phố Long Xuyên' => 'Phường Mỹ Bình,Phường Mỹ Long,Phường Đông Xuyên,Phường Mỹ Xuyên,Phường Bình Đức,Phường Bình Khánh,Phường Mỹ Phước,Phường Mỹ Quý,Phường Mỹ Thới,Phường Mỹ Thạnh,Phường Mỹ Hòa,Xã Mỹ Khánh,Xã Mỹ Hoà Hưng',
            'Thành phố Châu Đốc' => 'Phường Châu Phú B,Phường Châu Phú A,Phường Vĩnh Mỹ,Phường Núi Sam,Phường Vĩnh Ngươn,Xã Vĩnh Tế,Xã Vĩnh Châu',
            'Huyện An Phú' => 'Thị trấn An Phú,Xã Khánh An,Thị Trấn Long Bình,Xã Khánh Bình,Xã Quốc Thái,Xã Nhơn Hội,Xã Phú Hữu,Xã Phú Hội,Xã Phước Hưng,Xã Vĩnh Lộc,Xã Vĩnh Hậu,Xã Vĩnh Trường,Xã Vĩnh Hội Đông,Xã Đa Phước',
            'Thị xã Tân Châu' => 'Phường Long Thạnh,Phường Long Hưng,Phường Long Châu,Xã Phú Lộc,Xã Vĩnh Xương,Xã Vĩnh Hòa,Xã Tân Thạnh,Xã Tân An,Xã Long An,Phường Long Phú,Xã Châu Phong,Xã Phú Vĩnh,Xã Lê Chánh,Phường Long Sơn',
            'Huyện Phú Tân' => 'Thị trấn Phú Mỹ,Thị trấn Chợ Vàm,Xã Long Hoà,Xã Phú Long,Xã Phú Lâm,Xã Phú Hiệp,Xã Phú Thạnh,Xã Hoà Lạc,Xã Phú Thành,Xã Phú An,Xã Phú Xuân,Xã Hiệp Xương,Xã Phú Bình,Xã Phú Thọ,Xã Phú Hưng,Xã Bình Thạnh Đông,Xã Tân Hòa,Xã Tân Trung',
            'Huyện Châu Phú' => 'Thị trấn Cái Dầu,Xã Khánh Hòa,Xã Mỹ Đức,Xã Mỹ Phú,Xã Ô Long Vỹ,Thị trấn Vĩnh Thạnh Trung,Xã Thạnh Mỹ Tây,Xã Bình Long,Xã Bình Mỹ,Xã Bình Thủy,Xã Đào Hữu Cảnh,Xã Bình Phú,Xã Bình Chánh',
            'Huyện Tịnh Biên' => 'Thị trấn Nhà Bàng,Thị trấn Chi Lăng,Xã Núi Voi,Xã Nhơn Hưng,Xã An Phú,Xã Thới Sơn,Thị trấn Tịnh Biên,Xã Văn Giáo,Xã An Cư,Xã An Nông,Xã Vĩnh Trung,Xã Tân Lợi,Xã An Hảo,Xã Tân Lập',
            'Huyện Tri Tôn' => 'Thị trấn Tri Tôn,Thị trấn Ba Chúc,Xã Lạc Quới,Xã Lê Trì,Xã Vĩnh Gia,Xã Vĩnh Phước,Xã Châu Lăng,Xã Lương Phi,Xã Lương An Trà,Xã Tà Đảnh,Xã Núi Tô,Xã An Tức,Thị trấn Cô Tô,Xã Tân Tuyến,Xã Ô Lâm',
            'Huyện Châu Thành' => 'Thị trấn An Châu,Xã An Hòa,Xã Cần Đăng,Xã Vĩnh Hanh,Xã Bình Thạnh,Thị trấn Vĩnh Bình,Xã Bình Hòa,Xã Vĩnh An,Xã Hòa Bình Thạnh,Xã Vĩnh Lợi,Xã Vĩnh Nhuận,Xã Tân Phú,Xã Vĩnh Thành',
            'Huyện Chợ Mới' => 'Thị trấn Chợ Mới,Thị trấn Mỹ Luông,Xã Kiến An,Xã Mỹ Hội Đông,Xã Long Điền A,Xã Tấn Mỹ,Xã Long Điền B,Xã Kiến Thành,Xã Mỹ Hiệp,Xã Mỹ An,Xã Nhơn Mỹ,Xã Long Giang,Xã Long Kiến,Xã Bình Phước Xuân,Xã An Thạnh Trung,Xã Hội An,Xã Hòa Bình,Xã Hòa An',
            'Huyện Thoại Sơn' => 'Thị trấn Núi Sập,Thị trấn Phú Hoà,Thị Trấn Óc Eo,Xã Tây Phú,Xã An Bình,Xã Vĩnh Phú,Xã Vĩnh Trạch,Xã Phú Thuận,Xã Vĩnh Chánh,Xã Định Mỹ,Xã Định Thành,Xã Mỹ Phú Đông,Xã Vọng Đông,Xã Vĩnh Khánh,Xã Thoại Giang,Xã Bình Thành,Xã Vọng Thê',
        ],
        'Tỉnh Kiên Giang' => [
            'Thành phố Rạch Giá' => 'Phường Vĩnh Thanh Vân,Phường Vĩnh Thanh,Phường Vĩnh Quang,Phường Vĩnh Hiệp,Phường Vĩnh Bảo,Phường Vĩnh Lạc,Phường An Hòa,Phường An Bình,Phường Rạch Sỏi,Phường Vĩnh Lợi,Phường Vĩnh Thông,Xã Phi Thông',
            'Thành phố Hà Tiên' => 'Phường Tô Châu,Phường Đông Hồ,Phường Bình San,Phường Pháo Đài,Phường Mỹ Đức,Xã Tiên Hải,Xã Thuận Yên',
            'Huyện Kiên Lương' => 'Thị trấn Kiên Lương,Xã Kiên Bình,Xã Hòa Điền,Xã Dương Hòa,Xã Bình An,Xã Bình Trị,Xã Sơn Hải,Xã Hòn Nghệ',
            'Huyện Hòn Đất' => 'Thị trấn Hòn Đất,Thị trấn Sóc Sơn,Xã Bình Sơn,Xã Bình Giang,Xã Mỹ Thái,Xã Nam Thái Sơn,Xã Mỹ Hiệp Sơn,Xã Sơn Kiên,Xã Sơn Bình,Xã Mỹ Thuận,Xã Lình Huỳnh,Xã Thổ Sơn,Xã Mỹ Lâm,Xã Mỹ Phước',
            'Huyện Tân Hiệp' => 'Thị trấn Tân Hiệp,Xã Tân Hội,Xã Tân Thành,Xã Tân Hiệp B,Xã Tân Hoà,Xã Thạnh Đông B,Xã Thạnh Đông,Xã Tân Hiệp A,Xã Tân An,Xã Thạnh Đông A,Xã Thạnh Trị',
            'Huyện Châu Thành' => 'Thị trấn Minh Lương,Xã Mong Thọ A,Xã Mong Thọ B,Xã Mong Thọ,Xã Giục Tượng,Xã Vĩnh Hòa Hiệp,Xã Vĩnh Hoà Phú,Xã Minh Hòa,Xã Bình An,Xã Thạnh Lộc',
            'Huyện Giồng Riềng' => 'Thị Trấn Giồng Riềng,Xã Thạnh Hưng,Xã Thạnh Phước,Xã Thạnh Lộc,Xã Thạnh Hòa,Xã Thạnh Bình,Xã Bàn Thạch,Xã Bàn Tân Định,Xã Ngọc Thành,Xã Ngọc Chúc,Xã Ngọc Thuận,Xã Hòa Hưng,Xã Hoà Lợi,Xã Hoà An,Xã Long Thạnh,Xã Vĩnh Thạnh,Xã Vĩnh Phú,Xã  Hòa Thuận,Xã Ngọc Hoà',
            'Huyện Gò Quao' => 'Thị trấn Gò Quao,Xã Vĩnh Hòa Hưng Bắc,Xã Định Hòa,Xã Thới Quản,Xã Định An,Xã Thủy Liễu,Xã Vĩnh Hòa Hưng Nam,Xã Vĩnh Phước A,Xã Vĩnh Phước B,Xã Vĩnh Tuy,Xã Vĩnh Thắng',
            'Huyện An Biên' => 'Thị trấn Thứ Ba,Xã Tây Yên,Xã Tây Yên A,Xã Nam Yên,Xã Hưng Yên,Xã Nam Thái,Xã Nam Thái A,Xã Đông Thái,Xã Đông Yên',
            'Huyện An Minh' => 'Thị trấn Thứ Mười Một,Xã Thuận Hoà,Xã Đông Hòa,Xã Đông Thạnh,Xã Tân Thạnh,Xã Đông Hưng,Xã Đông Hưng A,Xã Đông Hưng B,Xã Vân Khánh,Xã Vân Khánh Đông,Xã Vân Khánh Tây',
            'Huyện Vĩnh Thuận' => 'Thị trấn Vĩnh Thuận,Xã Vĩnh Bình Bắc,Xã Vĩnh Bình Nam,Xã Bình Minh,Xã Vĩnh Thuận,Xã Tân Thuận,Xã Phong Đông,Xã Vĩnh Phong',
            'Thành phố Phú Quốc' => 'Phường Dương Đông,Phường An Thới,Xã Cửa Cạn,Xã Gành Dầu,Xã Cửa Dương,Xã Hàm Ninh,Xã Dương Tơ,Xã Bãi Thơm,Xã Thổ Châu',
            'Huyện Kiên Hải' => 'Xã Hòn Tre,Xã Lại Sơn,Xã An Sơn,Xã Nam Du',
            'Huyện U Minh Thượng' => 'Xã Thạnh Yên,Xã Thạnh Yên A,Xã An Minh Bắc,Xã Vĩnh Hòa,Xã Hoà Chánh,Xã Minh Thuận',
            'Huyện Giang Thành' => 'Xã Vĩnh Phú,Xã Vĩnh Điều,Xã Tân Khánh Hòa,Xã Phú Lợi,Xã Phú Mỹ',
        ],
        'Tỉnh Cần Thơ' => [
            'Quận Ninh Kiều' => 'Phường Cái Khế,Phường An Hòa,Phường Thới Bình,Phường An Nghiệp,Phường An Cư,Phường Tân An,Phường An Phú,Phường Xuân Khánh,Phường Hưng Lợi,Phường An Khánh,Phường An Bình',
            'Quận Ô Môn' => 'Phường Châu Văn Liêm,Phường Thới Hòa,Phường Thới Long,Phường Long Hưng,Phường Thới An,Phường Phước Thới,Phường Trường Lạc',
            'Quận Bình Thuỷ' => 'Phường Bình Thủy,Phường Trà An,Phường Trà Nóc,Phường Thới An Đông,Phường An Thới,Phường Bùi Hữu Nghĩa,Phường Long Hòa,Phường Long Tuyền',
            'Quận Cái Răng' => 'Phường Lê Bình,Phường Hưng Phú,Phường Hưng Thạnh,Phường Ba Láng,Phường Thường Thạnh,Phường Phú Thứ,Phường Tân Phú',
            'Quận Thốt Nốt' => 'Phường Thốt Nốt,Phường Thới Thuận,Phường Thuận An,Phường Tân Lộc,Phường Trung Nhứt,Phường Thạnh Hoà,Phường Trung Kiên,Phường Tân Hưng,Phường Thuận Hưng',
            'Huyện Vĩnh Thạnh' => 'Xã Vĩnh Bình,Thị trấn Thanh An,Thị trấn Vĩnh Thạnh,Xã Thạnh Mỹ,Xã Vĩnh Trinh,Xã Thạnh An,Xã Thạnh Tiến,Xã Thạnh Thắng,Xã Thạnh Lợi,Xã Thạnh Qưới,Xã Thạnh Lộc',
            'Huyện Cờ Đỏ' => 'Xã Trung An,Xã Trung Thạnh,Xã Thạnh Phú,Xã Trung Hưng,Thị trấn Cờ Đỏ,Xã Thới Hưng,Xã Đông Hiệp,Xã Đông Thắng,Xã Thới Đông,Xã Thới Xuân',
            'Huyện Phong Điền' => 'Thị trấn Phong Điền,Xã Nhơn Ái,Xã Giai Xuân,Xã Tân Thới,Xã Trường Long,Xã Mỹ Khánh,Xã Nhơn Nghĩa',
            'Huyện Thới Lai' => 'Thị trấn Thới Lai,Xã Thới Thạnh,Xã Tân Thạnh,Xã Xuân Thắng,Xã Đông Bình,Xã Đông Thuận,Xã Thới Tân,Xã Trường Thắng,Xã Định Môn,Xã Trường Thành,Xã Trường Xuân,Xã Trường Xuân A,Xã Trường Xuân B',
        ],
        'Tỉnh Hậu Giang' => [
            'Thành phố Vị Thanh' => 'Phường I,Phường III,Phường IV,Phường V,Phường VII,Xã Vị Tân,Xã Hoả Lựu,Xã Tân Tiến,Xã Hoả Tiến',
            'Thành phố Ngã Bảy' => 'Phường Ngã Bảy,Phường Lái Hiếu,Phường Hiệp Thành,Phường Hiệp Lợi,Xã Đại Thành,Xã Tân Thành',
            'Huyện Châu Thành A' => 'Thị trấn Một Ngàn,Xã Tân Hoà,Thị trấn Bảy Ngàn,Xã Trường Long Tây,Xã Trường Long A,Xã Nhơn Nghĩa A,Thị trấn Rạch Gòi,Xã Thạnh Xuân,Thị trấn Cái Tắc,Xã Tân Phú Thạnh',
            'Huyện Châu Thành' => 'Thị Trấn Ngã Sáu,Xã Đông Thạnh,Xã Đông Phú,Xã Phú Hữu,Xã Phú Tân,Thị trấn Mái Dầm,Xã Đông Phước,Xã Đông Phước A',
            'Huyện Phụng Hiệp' => 'Thị trấn Kinh Cùng,Thị trấn Cây Dương,Xã Tân Bình,Xã Bình Thành,Xã Thạnh Hòa,Xã Long Thạnh,Xã Phụng Hiệp,Xã Hòa Mỹ,Xã Hòa An,Xã Phương Bình,Xã Hiệp Hưng,Xã Tân Phước Hưng,Thị trấn Búng Tàu,Xã Phương Phú,Xã Tân Long',
            'Huyện Vị Thuỷ' => 'Thị trấn Nàng Mau,Xã Vị Trung,Xã Vị Thuỷ,Xã Vị Thắng,Xã Vĩnh Thuận Tây,Xã Vĩnh Trung,Xã Vĩnh Tường,Xã Vị Đông,Xã Vị Thanh,Xã Vị Bình',
            'Huyện Long Mỹ' => 'Xã Thuận Hưng,Xã Thuận Hòa,Xã Vĩnh Thuận Đông,Thị trấn Vĩnh Viễn,Xã Vĩnh Viễn A,Xã Lương Tâm,Xã Lương Nghĩa,Xã Xà Phiên',
            'Thị xã Long Mỹ' => 'Phường Thuận An,Phường Trà Lồng,Phường Bình Thạnh,Xã Long Bình,Phường Vĩnh Tường,Xã Long Trị,Xã Long Trị A,Xã Long Phú,Xã Tân Phú',
        ],
        'Tỉnh Sóc Trăng' => [
            'Thành phố Sóc Trăng' => 'Phường 5,Phường 7,Phường 8,Phường 6,Phường 2,Phường 1,Phường 4,Phường 3,Phường 9,Phường 10',
            'Huyện Châu Thành' => 'Thị trấn Châu Thành,Xã Hồ Đắc Kiện,Xã Phú Tâm,Xã Thuận Hòa,Xã Phú Tân,Xã Thiện Mỹ,Xã An Hiệp,Xã An Ninh',
            'Huyện Kế Sách' => 'Thị trấn Kế Sách,Thị trấn An Lạc Thôn,Xã Xuân Hòa,Xã Phong Nẫm,Xã An Lạc Tây,Xã Trinh Phú,Xã Ba Trinh,Xã Thới An Hội,Xã Nhơn Mỹ,Xã Kế Thành,Xã Kế An,Xã Đại Hải,Xã An Mỹ',
            'Huyện Mỹ Tú' => 'Thị trấn Huỳnh Hữu Nghĩa,Xã Long Hưng,Xã Hưng Phú,Xã Mỹ Hương,Xã Mỹ Tú,Xã Mỹ Phước,Xã Thuận Hưng,Xã Mỹ Thuận,Xã Phú Mỹ',
            'Huyện Cù Lao Dung' => 'Thị trấn Cù Lao Dung,Xã An Thạnh 1,Xã An Thạnh Tây,Xã An Thạnh Đông,Xã Đại Ân 1,Xã An Thạnh 2,Xã An Thạnh 3,Xã An Thạnh Nam',
            'Huyện Long Phú' => 'Thị trấn Long Phú,Xã Song Phụng,Thị trấn Đại Ngãi,Xã Hậu Thạnh,Xã Long Đức,Xã Trường Khánh,Xã Phú Hữu,Xã Tân Hưng,Xã Châu Khánh,Xã Tân Thạnh,Xã Long Phú',
            'Huyện Mỹ Xuyên' => 'Thị trấn Mỹ Xuyên,Xã Đại Tâm,Xã Tham Đôn,Xã Thạnh Phú,Xã Ngọc Đông,Xã Thạnh Quới,Xã Hòa Tú 1,Xã Gia Hòa 1,Xã Ngọc Tố,Xã Gia Hòa 2,Xã Hòa Tú II',
            'Thị xã Ngã Năm' => 'Phường 1,Phường 2,Xã Vĩnh Quới,Xã Tân Long,Xã Long Bình,Phường 3,Xã Mỹ Bình',
            'Huyện Thạnh Trị' => 'Thị trấn Phú Lộc,Thị trấn Hưng Lợi,Xã Lâm Tân,Xã Thạnh Tân,Xã Lâm Kiết,Xã Tuân Tức,Xã Vĩnh Thành,Xã Thạnh Trị,Xã Vĩnh Lợi,Xã Châu Hưng',
            'Thị xã Vĩnh Châu' => 'Phường 1,Xã Hòa Đông,Phường Khánh Hòa,Xã Vĩnh Hiệp,Xã Vĩnh Hải,Xã Lạc Hòa,Phường 2,Phường Vĩnh Phước,Xã Vĩnh Tân,Xã Lai Hòa',
            'Huyện Trần Đề' => 'Xã Đại Ân  2,Thị trấn Trần Đề,Xã Liêu Tú,Xã Lịch Hội Thượng,Thị trấn Lịch Hội Thượng,Xã Trung Bình,Xã Tài Văn,Xã Viên An,Xã Thạnh Thới An,Xã Thạnh Thới Thuận,Xã Viên Bình',
        ],
        'Tỉnh Bạc Liêu' => [
            'Thành phố Bạc Liêu' => 'Phường 2,Phường 3,Phường 5,Phường 7,Phường 1,Phường 8,Phường Nhà Mát,Xã Vĩnh Trạch,Xã Vĩnh Trạch Đông,Xã Hiệp Thành',
            'Huyện Hồng Dân' => 'Thị trấn Ngan Dừa,Xã Ninh Quới,Xã Ninh Quới A,Xã Ninh Hòa,Xã Lộc Ninh,Xã Vĩnh Lộc,Xã Vĩnh Lộc A,Xã Ninh Thạnh Lợi A,Xã Ninh Thạnh Lợi',
            'Huyện Phước Long' => 'Thị trấn Phước Long,Xã Vĩnh Phú Đông,Xã Vĩnh Phú Tây,Xã Phước Long,Xã Hưng Phú,Xã Vĩnh Thanh,Xã Phong Thạnh Tây A,Xã Phong Thạnh Tây B',
            'Huyện Vĩnh Lợi' => 'Xã Vĩnh Hưng,Xã Vĩnh Hưng A,Thị trấn Châu Hưng,Xã Châu Hưng A,Xã Hưng Thành,Xã Hưng Hội,Xã Châu Thới,Xã Long Thạnh',
            'Thị xã Giá Rai' => 'Phường 1,Phường Hộ Phòng,Xã Phong Thạnh Đông,Phường Láng Tròn,Xã Phong Tân,Xã Tân Phong,Xã Phong Thạnh,Xã Phong Thạnh A,Xã Phong Thạnh Tây,Xã Tân Thạnh',
            'Huyện Đông Hải' => 'Thị trấn Gành Hào,Xã Long Điền Đông,Xã Long Điền Đông A,Xã Long Điền,Xã Long Điền Tây,Xã Điền Hải,Xã An Trạch,Xã An Trạch A,Xã An Phúc,Xã Định Thành,Xã Định Thành A',
            'Huyện Hoà Bình' => 'Thị trấn Hòa Bình,Xã Minh Diệu,Xã Vĩnh Bình,Xã Vĩnh Mỹ B,Xã Vĩnh Hậu,Xã Vĩnh Hậu A,Xã Vĩnh Mỹ A,Xã Vĩnh Thịnh',
        ],
        'Tỉnh Cà Mau' => [
            'Thành phố Cà Mau' => 'Phường 9,Phường 4,Phường 1,Phường 5,Phường 2,Phường 8,Phường 6,Phường 7,Phường Tân Xuyên,Xã An Xuyên,Phường Tân Thành,Xã Tân Thành,Xã Tắc Vân,Xã Lý Văn Lâm,Xã Định Bình,Xã Hòa Thành,Xã Hòa Tân',
            'Huyện U Minh' => 'Thị trấn U Minh,Xã Khánh Hòa,Xã Khánh Thuận,Xã Khánh Tiến,Xã Nguyễn Phích,Xã Khánh Lâm,Xã Khánh An,Xã Khánh Hội',
            'Huyện Thới Bình' => 'Thị trấn Thới Bình,Xã Biển Bạch,Xã Tân Bằng,Xã Trí Phải,Xã Trí Lực,Xã Biển Bạch Đông,Xã Thới Bình,Xã Tân Phú,Xã Tân Lộc Bắc,Xã Tân Lộc,Xã Tân Lộc Đông,Xã Hồ Thị Kỷ',
            'Huyện Trần Văn Thời' => 'Thị trấn Trần Văn Thời,Thị trấn Sông Đốc,Xã Khánh Bình Tây Bắc,Xã Khánh Bình Tây,Xã Trần Hợi,Xã Khánh Lộc,Xã Khánh Bình,Xã Khánh Hưng,Xã Khánh Bình Đông,Xã Khánh Hải,Xã Lợi An,Xã Phong Điền,Xã Phong Lạc',
            'Huyện Cái Nước' => 'Thị trấn Cái Nước,Xã Thạnh Phú,Xã Lương Thế Trân,Xã Phú Hưng,Xã Tân Hưng,Xã Hưng Mỹ,Xã Hoà Mỹ,Xã Đông Hưng,Xã Đông Thới,Xã Tân Hưng Đông,Xã Trần Thới',
            'Huyện Đầm Dơi' => 'Thị trấn Đầm Dơi,Xã Tạ An Khương,Xã Tạ An Khương  Đông,Xã Trần Phán,Xã Tân Trung,Xã Tân Đức,Xã Tân Thuận,Xã Tạ An Khương  Nam,Xã Tân Duyệt,Xã Tân Dân,Xã Tân Tiến,Xã Quách Phẩm Bắc,Xã Quách Phẩm,Xã Thanh Tùng,Xã Ngọc Chánh,Xã Nguyễn Huân,Thị Trấn Năm Căn',
            'Huyện Năm Căn' => 'Thị Trấn Năm Căn,Xã Hàm Rồng,Xã Hiệp Tùng,Xã Đất Mới,Xã Lâm Hải,Xã Hàng Vịnh,Xã Tam Giang,Xã Tam Giang Đông',
            'Huyện Phú Tân' => 'Thị trấn Cái Đôi Vàm,Xã Phú Thuận,Xã Phú Mỹ,Xã Phú Tân,Xã Tân Hải,Xã Việt Thắng,Xã Tân Hưng Tây,Xã Rạch Chèo,Xã Nguyễn Việt Khái',
            'Huyện Ngọc Hiển' => 'Xã Tam Giang Tây,Xã Tân Ân Tây,Xã Viên An Đông,Xã Viên An,Thị trấn Rạch Gốc,Xã Tân Ân,Xã Đất Mũi',
        ]
    ];

    public static function insertSampleGeoLocation()
    {
        $count = 0;
        foreach (self::$arrWardDistrictProvince as $province => $districts) {
            $model = new GeoLocation();
            $model->name = $province;
            $model->slug = StringHelper::toSlug($province);
            $model->parent = 0;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                $count++;
                foreach ($districts as $district => $ward) {
                    $districtModel = new GeoLocation();
                    $districtModel->name = $district;
                    $districtModel->slug = StringHelper::toSlug($district);
                    $districtModel->parent = $model->id;
                    $districtModel->created_at = date('Y-m-d H:i:s');
                    $districtModel->updated_at = date('Y-m-d H:i:s');
                    if ($districtModel->save()) {
                        $count++;
                        $arrVillage = explode(",", $ward);
                        foreach ($arrVillage as $village) {
                            $villageModel = new GeoLocation();
                            $villageModel->name = $village;
                            $villageModel->slug = StringHelper::toSlug($village);
                            $villageModel->parent = $districtModel->id;
                            $villageModel->created_at = date('Y-m-d H:i:s');
                            $villageModel->updated_at = date('Y-m-d H:i:s');
                            if ($villageModel->save()) {
                                $count++;
                            }
                        }
                    }
                }
            }
        }
        echo "Inserted " . $count . '/' . count(self::$arrWardDistrictProvince) . ' geo location.' . PHP_EOL;
    }

    public static $arrSocialNetwork = [
        [
            'icon' => '<i class="fab fa-facebook-f" aria-hidden="true"></i>',
            'link' => 'https://www.facebook.com/',
        ],
        [
            'icon' => '<i class="fab fa-instagram"></i>',
            'link' => 'https://www.instagram.com/',
        ],
        [
            'icon' => '<i class="fab fa-youtube"></i>',
            'link' => 'https://www.youtube.com/',
        ],
        [
            'icon' => '<i class="fab fa-twitter"></i>',
            'link' => 'https://twitter.com/',
        ],
        [
            'icon' => '<i class="fab fa-google-plus"></i>',
            'link' => 'https://plus.google.com/',
        ],
    ];

    public static function insertSampleSocialNetwork()
    {
        $count = 0;
        foreach (self::$arrSocialNetwork as $social) {
            $model = new Social();
            $model->icon = $social['icon'];
            $model->link = $social['link'];
            $model->admin_id = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                $count++;
            }
        }
        echo "Inserted " . $count . '/' . count(self::$arrSocialNetwork) . ' social network.' . PHP_EOL;
    }

    /**
     * @throws Exception
     */
    public static function importAllSampleData()
    {
        self::insertSampleUser();
//        self::insertSampleProduct();
//        self::insertSampleProductAssoc();
//        self::insertSampleProductType();
//        self::insertSampleProductCategory();
//        self::insertSampleTrademark();
//        self::insertSamplePost();
//        self::insertSamplePostTag();
//        self::insertSamplePostCategory();
        self::insertSampleTerms();
//        self::insertSampleCart();
//        self::insertSampleSocialNetwork();
//        self::insertSampleOurStories();
//        self::insertSampleGeoLocation();
//        self::insertSampleOrder();
//        self::insertSampleOrderTracking();
//        self::insertSampleTrackingStatus();
    }
}