<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

#[AsTwigComponent]
final class ChartComponent
{
    private Chart $chart;
    
    public function __construct(private ChartBuilderInterface $chartBuilder)
    {
    }
    
    public function mount(string $type = Chart::TYPE_LINE, array $labels = [], array $datasets = [], array $options = []): void
    {
        // Create chart of specified type (defaults to line chart)
        $this->chart = $this->chartBuilder->createChart($type);
        
        // Set default data if none provided
        if (empty($labels)) {
            $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        }
        
        if (empty($datasets)) {
            $datasets = [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ]
            ];
        }
        
        // Set chart data
        $this->chart->setData([
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
        
        // Set default options if none provided
        if (empty($options)) {
            $options = [
                'scales' => [
                    'y' => [
                        'suggestedMin' => 0,
                        'suggestedMax' => 100,
                    ],
                ],
            ];
        }
        
        // Set chart options
        $this->chart->setOptions($options);
    }
    
    public function getChart(): Chart
    {
        return $this->chart;
    }
}
