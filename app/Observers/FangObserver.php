<?php

namespace App\Observers;

use App\Models\Fang;
use GuzzleHttp\Client;
class FangObserver
{
    public function creating(Fang $fang)
    {
        $geo=$this->geo();
        $fang->longitude=$geo[0];
        $fang->latitude=$geo[1];
        $fang->fang_config=implode(',',request()->get('fang_config'));
    }

    public function created(Fang $fang)
    {
        $hosts=config('es.hosts');
        $client=\Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        $params=[
            // 索引名称
            'index' => 'fangs',
//            'type' => '_doc',
            // 可以不定义，它会自动给生成
            'id' => $fang->id,
            // 文档字段内容
            'body' => [
                'xiaoqu' => $fang->fang_xiaoqu,
                'desn' => $fang->fang_desn,
            ],
        ];
        $client->index($params);
    }

    public function updating(Fang $fang)
    {
        if(request()->get('fang_addr2')!= request()->get('fang_attr')){
            $geo=$this->geo();
            $fang->longitude=$geo[0];
            $fang->latitude=$geo[1];
        }
        $fang->fang_config=implode(',',request()->get('fang_config'));
    }

    public function updated(Fang $fang)
    {
        $this->created($fang);
    }
    private function geo(){
        $url=sprintf(config('geo.url'),request()->get('fang_addr'));
        $client=new Client(['timeout'=>5,'verify'=>false]);
        $response=$client->get($url);
        $json=(string)$response->getBody();
        $arr=\GuzzleHttp\json_decode($json,true)['geocodes'];
        $longitude=$latitude=0;
        if(count($arr > 0)){
            $location=$arr[0]['location'];
            [$longitude,$latitude]=explode(',',$location);
        }
        return [$longitude,$latitude];
    }
}
