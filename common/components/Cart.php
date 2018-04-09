<?php
namespace common\components;

//use common\models\engine\OrderStatusModel;
use Yii;
//use common\models\engine\OrderModel;
//use common\models\engine\OrderProductModel;
//use common\models\engine\User;
use yii\base\Component;

/**
 * @property OrderModel $order;
 * @property string $status
*/
class Cart extends Component
{
    const SESSION_KEY_ORDER_ID = 'order_id';

    /* @var User $_user */
    private $_user;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->_user = Yii::$app->user->identity;
    }

    /**
     * @param $productId
     * @param $count
     * @return bool|null
     */
    public function add($productId, $count)
    {
        if($productId == null || $count == 0) return null;

        $order = $this->order;

        if(!$order){
            $order = new OrderModel();
            $order->ID_USER = $this->_user->id;
            $order->NAME = $this->_user->NAME;
            $order->SURNAME = $this->_user->SURNAME;
            $order->EMAIL = $this->_user->EMAIL;
            $order->ID_ORDER_STATUS = OrderStatusModel::NEW_ORDER;

            if (!$order->save()) {
                return null;
            }
            //Yii::$app->session->set(self::SESSION_KEY_ORDER_ID, $order->ID);
        }

        /* @var OrderProductModel $orderProduct*/
        $orderProduct = $order->getOrderProductByIdProduct($productId);

        if (!$orderProduct) {
            $orderProduct = new OrderProductModel();
        }

        $orderProduct->ID_PRODUCT = $productId;
        $orderProduct->ID_ORDER = $order->ID;
        $orderProduct->COUNT += $count;

        if($orderProduct->COUNT > 0){
            return $orderProduct->save();
        } else {
            return $this->order->DeleteOrderProduct($orderProduct->ID_PRODUCT);
        }

    }


//    public function setCount($productId, $count)
//    {
//        $link = OrderProduct::findOne([
//            'product_id' => $productId,
//            'order_id' => $this->getOrderId()
//        ]);
//
//        if (!$link) {
//            return false;
//        }
//
//        $link->count = $count;
//        return $link->save();
//    }

//    private function isEmpty()
//    {
//        if (!Yii::$app->session->has(self::SESSION_KEY_ORDER_ID)) {
//            return true;
//        }
//        return $this->order->productsCount ? false : true;
//    }

//    public function getStatus()
//    {
//        if ($this->isEmpty()) {
//            return Yii::t('app', 'В корзине пусто');
//        }
//        return Yii::t('app', 'В корзине {productsCount, number} {productsCount, plural, one{товар} few{товара} many{товаров} other{товара}} на сумму {amount} руб.', [
//            'productsCount' => $this->order->productsCount,
//            'amount' => $this->order->amount
//        ]);
//    }

    /**
     * Получить экземпляр заказа. Заказ который в статусе "новый"
    */
    public function getOrder()
    {
        $order = OrderModel::findOne([
            'ID_USER' => $this->_user->ID,
            'ID_ORDER_STATUS' => OrderStatusModel::NEW_ORDER
        ]);

        if($order){
            return $order;
        } else {
            return null;
        }

//        $order = null;
//        $idOrder = null;
//
//        if (Yii::$app->session->has(self::SESSION_KEY_ORDER_ID)) {
//            $idOrder = Yii::$app->session->get(self::SESSION_KEY_ORDER_ID);
//
//            $order =  OrderModel::findOne([
//                'ID' => $idOrder,
//                'STATUS' => self::STATUS_NEW_ORDER
//            ]);
//        } else {
//
//        }
    }
}