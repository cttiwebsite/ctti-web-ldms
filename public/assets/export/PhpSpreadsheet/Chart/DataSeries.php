<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataSeries
{
    public const TYPE_BARCHART = 'barChart';
    public const TYPE_BARCHART_3D = 'bar3DChart';
    public const TYPE_LINECHART = 'lineChart';
    public const TYPE_LINECHART_3D = 'line3DChart';
    public const TYPE_AREACHART = 'areaChart';
    public const TYPE_AREACHART_3D = 'area3DChart';
    public const TYPE_PIECHART = 'pieChart';
    public const TYPE_PIECHART_3D = 'pie3DChart';
    public const TYPE_DOUGHNUTCHART = 'doughnutChart';
    public const TYPE_DONUTCHART = self::TYPE_DOUGHNUTCHART; // Synonym
    public const TYPE_SCATTERCHART = 'scatterChart';
    public const TYPE_SURFACECHART = 'surfaceChart';
    public const TYPE_SURFACECHART_3D = 'surface3DChart';
    public const TYPE_RADARCHART = 'radarChart';
    public const TYPE_BUBBLECHART = 'bubbleChart';
    public const TYPE_STOCKCHART = 'stockChart';
    public const TYPE_CANDLECHART = self::TYPE_STOCKCHART; // Synonym

    public const GROUPING_CLUSTERED = 'clustered';
    public const GROUPING_STACKED = 'stacked';
    public const GROUPING_PERCENT_STACKED = 'percentStacked';
    public const GROUPING_STANDARD = 'standard';

    public const DIRECTION_BAR = 'bar';
    public const DIRECTION_HORIZONTAL = self::DIRECTION_BAR;
    public const DIRECTION_COL = 'col';
    public const DIRECTION_COLUMN = self::DIRECTION_COL;
    public const DIRECTION_VERTICAL = self::DIRECTION_COL;

    public const STYLE_LINEMARKER = 'lineMarker';
    public const STYLE_SMOOTHMARKER = 'smoothMarker';
    public const STYLE_MARKER = 'marker';
    public const STYLE_FILLED = 'filled';

    /**
     * Series Plot Type.
     *
     * @var string
     */
    private $plotType;

    /**
     * Plot Grouping Type.
     *
     * @var string
     */
    private $plotGrouping;

    /**
     * Plot Direction.
     *
     * @var string
     */
    private $plotDirection;

    /**
     * Plot Style.
     *
     * @var null|string
     */
    private $plotStyle;

    /**
     * Order of plots in Series.
     *
     * @var array of integer
     */
    private $plotOrder = [];

    /**
     * Plot Label.
     *
     * @var array of DataSeriesValues
     */
    private $plotLabel = [];

    /**
     * Plot Category.
     *
     * @var array of DataSeriesValues
     */
    private $plotCategory = [];

    /**
     * Smooth Line.
     *
     * @var bool
     */
    private $smoothLine;

    /**
     * Plot Values.
     *
     * @var array of DataSeriesValues
     */
    private $plotValues = [];

    /**
     * Create a new DataSeries.
     *
     * @param null|mixed $plotType
     * @param null|mixed $plotGrouping
     * @param int[] $plotOrder
     * @param DataSeriesValues[] $plotLabel
     * @param DataSeriesValues[] $plotCategory
     * @param DataSeriesValues[] $plotValues
     * @param null|string $plotDirection
     * @param bool $smoothLine
     * @param null|string $plotStyle
     */
    public function __construct($plotType = null, $plotGrouping = null, array $plotOrder = [], array $plotLabel = [], array $plotCategory = [], array $plotValues = [], $plotDirection = null, $smoothLine = false, $plotStyle = null)
    {
        $this->plotType = $plotType;
        $this->plotGrouping = $plotGrouping;
        $this->plotOrder = $plotOrder;
        $keys = array_keys($plotValues);
        $this->plotValues = $plotValues;
        if ((count($plotLabel) == 0) || ($plotLabel[$keys[0]] === null)) {
            $plotLabel[$keys[0]] = new DataSeriesValues();
        }
        $this->plotLabel = $plotLabel;

        if ((count($plotCategory) == 0) || ($plotCategory[$keys[0]] === null)) {
            $plotCategory[$keys[0]] = new DataSeriesValues();
        }
        $this->plotCategory = $plotCategory;

        $this->smoothLine = $smoothLine;
        $this->plotStyle = $plotStyle;

        if ($plotDirection === null) {
            $plotDirection = self::DIRECTION_COL;
        }
        $this->plotDirection = $plotDirection;
    }

    /**
     * Get Plot Type.
     *
     * @return string
     */
    public function getPlotType()
    {
        return $this->plotType;
    }

    /**
     * Set Plot Type.
     *
     * @param string $plotType
     *
     * @return DataSeries
     */
    public function setPlotType($plotType)
    {
        $this->plotType = $plotType;

        return $this;
    }

    /**
     * Get Plot Grouping Type.
     *
     * @return string
     */
    public function getPlotGrouping()
    {
        return $this->plotGrouping;
    }

    /**
     * Set Plot Grouping Type.
     *
     * @param string $groupingType
     *
     * @return DataSeries
     */
    public function setPlotGrouping($groupingType)
    {
        $this->plotGrouping = $groupingType;

        return $this;
    }

    /**
     * Get Plot Direction.
     *
     * @return string
     */
    public function getPlotDirection()
    {
        return $this->plotDirection;
    }

    /**
     * Set Plot Direction.
     *
     * @param string $plotDirection
     *
     * @return DataSeries
     */
    public function setPlotDirection($plotDirection)
    {
        $this->plotDirection = $plotDirection;

        return $this;
    }

    /**
     * Get Plot Order.
     *
     * @return string
     */
    public function getPlotOrder()
    {
        return $this->plotOrder;
    }

    /**
     * Get Plot Labels.
     *
     * @return array of DataSeriesValues
     */
    public function getPlotLabels()
    {
        return $this->plotLabel;
    }

    /**
     * Get Plot Label by Index.
     *
     * @param mixed $index
     *
     * @return DataSeriesValues
     */
    public function getPlotLabelByIndex($index)
    {
        $keys = array_keys($this->plotLabel);
        if (in_array($index, $keys)) {
            return $this->plotLabel[$index];
        } elseif (isset($keys[$index])) {
            return $this->plotLabel[$keys[$index]];
        }

        return false;
    }

    /**
     * Get Plot Categories.
     *
     * @return array of DataSeriesValues
     */
    public function getPlotCategories()
    {
        return $this->plotCategory;
    }

    /**
     * Get Plot Category by Index.
     *
     * @param mixed $index
     *
     * @return DataSeriesValues
     */
    public function getPlotCategoryByIndex($index)
    {
        $keys = array_keys($this->plotCategory);
        if (in_array($index, $keys)) {
            return $this->plotCategory[$index];
        } elseif (isset($keys[$index])) {
            return $this->plotCategory[$keys[$index]];
        }

        return false;
    }

    /**
     * Get Plot Style.
     *
     * @return null|string
     */
    public function getPlotStyle()
    {
        return $this->plotStyle;
    }

    /**
     * Set Plot Style.
     *
     * @param null|string $plotStyle
     *
     * @return DataSeries
     */
    public function setPlotStyle($plotStyle)
    {
        $this->plotStyle = $plotStyle;

        return $this;
    }

    /**
     * Get Plot Values.
     *
     * @return array of DataSeriesValues
     */
    public function getPlotValues()
    {
        return $this->plotValues;
    }

    /**
     * Get Plot Values by Index.
     *
     * @param mixed $index
     *
     * @return DataSeriesValues
     */
    public function getPlotValuesByIndex($index)
    {
        $keys = array_keys($this->plotValues);
        if (in_array($index, $keys)) {
            return $this->plotValues[$index];
        } elseif (isset($keys[$index])) {
            return $this->plotValues[$keys[$index]];
        }

        return false;
    }

    /**
     * Get Number of Plot Series.
     *
     * @return int
     */
    public function getPlotSeriesCount()
    {
        return count($this->plotValues);
    }

    /**
     * Get Smooth Line.
     *
     * @return bool
     */
    public function getSmoothLine()
    {
        return $this->smoothLine;
    }

    /**
     * Set Smooth Line.
     *
     * @param bool $smoothLine
     *
     * @return DataSeries
     */
    public function setSmoothLine($smoothLine)
    {
        $this->smoothLine = $smoothLine;

        return $this;
    }

    public function refresh(Worksheet $worksheet)
    {
        foreach ($this->plotValues as $plotValues) {
            if ($plotValues !== null) {
                $plotValues->refresh($worksheet, true);
            }
        }
        foreach ($this->plotLabel as $plotValues) {
            if ($plotValues !== null) {
                $plotValues->refresh($worksheet, true);
            }
        }
        foreach ($this->plotCategory as $plotValues) {
            if ($plotValues !== null) {
                $plotValues->refresh($worksheet, false);
            }
        }
    }
}
