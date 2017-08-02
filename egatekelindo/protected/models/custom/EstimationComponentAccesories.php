<?php

class EstimationComponentAccesories extends EstimationComponentAccesoriesBase
{
        public $basic_price;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
        
        public function getBasicPrice($estimationBrandDiscounts)
        {
                $price = 0;
                
                if($this->component_id != NULL)
                {
                    if ($this->component->component_brand_discount_id != NULL)
                    {
                        foreach ($estimationBrandDiscounts as $estimationBrandDiscount) {
                            if ($estimationBrandDiscount->component_brand_discount_id == $this->component->component_brand_discount_id) {
                                $price_1 = $estimationBrandDiscount->value_1 > 0 ? $estimationBrandDiscount->value_1 : 1;
                                $price_2 = $estimationBrandDiscount->value_2 > 0 ? $estimationBrandDiscount->value_2 : 1;
                                $price_3 = $estimationBrandDiscount->value_3 > 0 ? $estimationBrandDiscount->value_3 : 1;
                                $price_4 = $estimationBrandDiscount->value_4 > 0 ? $estimationBrandDiscount->value_4 : 1;
                                $price_5 = $estimationBrandDiscount->value_5 > 0 ? $estimationBrandDiscount->value_5 : 1;
                                $rate = $estimationBrandDiscount->currentRate > 0 ? $estimationBrandDiscount->currentRate : 1;

                                $price = $price_1 * $price_2 * $price_3 * $price_4 * $price_5 * $this->unit_price * $rate;
                            }
                        }
                    }
                    
                }else {
                    if ($this->componentCu->component_brand_discount_id != NULL)
                    {
                        foreach ($estimationBrandDiscounts as $estimationBrandDiscount) {
                            if ($estimationBrandDiscount->component_brand_discount_id == $this->componentCu->component_brand_discount_id) {
                                $price_1 = $estimationBrandDiscount->value_1 > 0 ? $estimationBrandDiscount->value_1 : 1;
                                $price_2 = $estimationBrandDiscount->value_2 > 0 ? $estimationBrandDiscount->value_2 : 1;
                                $price_3 = $estimationBrandDiscount->value_3 > 0 ? $estimationBrandDiscount->value_3 : 1;
                                $price_4 = $estimationBrandDiscount->value_4 > 0 ? $estimationBrandDiscount->value_4 : 1;
                                $price_5 = $estimationBrandDiscount->value_5 > 0 ? $estimationBrandDiscount->value_5 : 1;
                                $rate = $estimationBrandDiscount->currentRate > 0 ? $estimationBrandDiscount->currentRate : 1;

                                $price = $price_1 / $price_2 ;
                            }
                        }
                    }
                   
                }
                
                return $price;

        }
        
        public function getBasicPriceOnly()
        {
                $price = 0;
                
                if($this->component_id != NULL)
                {
                    if ($this->estimation_brand_discount_id != NULL)
                    {
                        $price_1 = $this->estimationBrandDiscount->value_1 > 0 ? $this->estimationBrandDiscount->value_1 : 1;
                        $price_2 = $this->estimationBrandDiscount->value_2 > 0 ? $this->estimationBrandDiscount->value_2 : 1;
                        $price_3 = $this->estimationBrandDiscount->value_3 > 0 ? $this->estimationBrandDiscount->value_3 : 1;
                        $price_4 = $this->estimationBrandDiscount->value_4 > 0 ? $this->estimationBrandDiscount->value_4 : 1;
                        $price_5 = $this->estimationBrandDiscount->value_5 > 0 ? $this->estimationBrandDiscount->value_5 : 1;
                        $rate = $this->estimationBrandDiscount->currentRate > 0 ? $this->estimationBrandDiscount->currentRate : 1;

                        $price = $price_1 * $price_2 * $price_3 * $price_4 * $price_5 * $this->unit_price ;

                    }
                    else
                        $price = $this->unit_price;
                }
                else
                {
                   if ($this->componentCu->component_brand_discount_id != NULL)
                    {
                       if ($this->estimation_brand_discount_id != NULL)
                       {
                            $price_1 = $this->estimationBrandDiscount->value_1 > 0 ? $this->estimationBrandDiscount->value_1 : 1;
                            $price_2 = $this->estimationBrandDiscount->value_2 > 0 ? $this->estimationBrandDiscount->value_2 : 1;
                            $price_3 = $this->estimationBrandDiscount->value_3 > 0 ? $this->estimationBrandDiscount->value_3 : 1;
                            $price_4 = $this->estimationBrandDiscount->value_4 > 0 ? $this->estimationBrandDiscount->value_4 : 1;
                            $price_5 = $this->estimationBrandDiscount->value_5 > 0 ? $this->estimationBrandDiscount->value_5 : 1;
                            $rate = $this->estimationBrandDiscount->currentRate > 0 ? $this->estimationBrandDiscount->currentRate : 1;

                            $price = $price_1 / $price_2 ;
                        }
                        
                    } 
                }
                
                return $price;

        }
	
	public function getTotal($estimationBrandDiscounts)
	{
		
            if($this->component_id != NULL)
                return $this->quantity * $this->getBasicPrice($estimationBrandDiscounts);
            else
                return $this->quantity * $this->weight * $this->getBasicPrice($estimationBrandDiscounts);
	}
	
	public function getSubTotal($estimationBrandDiscounts)	
	{
		return $this->quantity * $this->getBasicPrice($estimationBrandDiscounts);
	}
        
        
        public function getTotalOnly()
	{
            if($this->component_id != NULL)
		return $this->quantity * $this->unit_price;
            else
                return $this->quantity * $this->weight * $this->unit_price;
	}
	
	public function getSubTotalOnly()	
	{
		return $this->quantity * $this->getBasicPriceOnly();
	}
}