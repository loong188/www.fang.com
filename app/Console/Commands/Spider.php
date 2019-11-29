<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use QL\QueryList;
class Spider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //自定义命令
    protected $signature = 'long:sqider';

    /**
     * The console command description.
     *
     * @var string
     */
    //命令解释
    protected $description = '数据采集脚本';

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
    //命令执行的地方
    public function handle()
    {
//        echo "执行命令\n";
        QueryList::run('Multi',[
            //待采集链接集合
            'list' => [
                'https://news.ke.com/bj/baike/033/pg1/',
                'https://news.ke.com/bj/baike/033/pg2/',
                'https://news.ke.com/bj/baike/033/pg3/'
                //更多的采集链接....
            ],
            'curl' => [
                'opt' => array(
                    //这里根据自身需求设置curl参数
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_AUTOREFERER => true,
                    //........
                ),
                //设置线程数
                'maxThread' => 100,
                //设置最大尝试数
                'maxTry' => 10
            ],
            'success' => function($ret){
                //采集规则
                $reg =[
                    //采集文章标题
                    'title' => ['.text .tit','text'],
                    'desc'=>['.text .summary','text'],
                    'pic'=>['.item .img img ','data-original'],
                    'cnt_url'=>['.item a.img','href']
                ];
                $ql = QueryList::Query($ret['content'],$reg);
                $data = $ql->getData();
//                dump($data);exit;
                //打印结果，实际操作中这里应该做入数据库操作
                foreach ($data as $item) {
                    $item['cid']=2;
                    $item['body']='';
                    Article::create($item);
                }
                echo "ok\n";
            }
        ]);
    }
}
