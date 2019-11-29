<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QL\QueryList;
use App\Models\Article;
class Sipdercnt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'long:cnt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //查找数据中cnt_url地址
        $data= \DB::table('articles')->where('is_spider',0)->get(['id','cnt_url'])->toArray();
//        dump($data);exit;
        QueryList::run('Multi', [
            // 多线程扩展
            'list' => array_column($data,'cnt_url'),
            // 线程curl的相关设置
            'curl' => [
                'opt' => array(
                    //这里根据自身需求设置curl参数
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_AUTOREFERER => true
                ),
                //设置线程数
                'maxThread' => 100,
                //设置最大尝试数
                'maxTry' => 10
            ],
            // 采集到数据回调处理
            'success' => function ($ret) {
                // 采集规则
                $reg = [
                    'body' => ['.article-detail', 'html'],
                ];
                //根据url地址来获取对应修改
                $cnt_url=$ret['info']['url'];
                $ql = QueryList::Query($ret['content'], $reg);
                $data = $ql->getData();
                //查找到的内容
               $body=$data[0]['body'] ?? '';
                \DB::table('articles')->where('cnt_url',$cnt_url)->update([
                    'body'=>$body,
                    'is_spider'=>1
                ]);
                echo "ok\n";
            }
        ]);
    }
}
