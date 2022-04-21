<?php

namespace P;

use DOMNode;

/**
 * @property string $accentColor
 * @property string $additiveSymbols
 * @property string $alignContent
 * @property string $alignItems
 * @property string $alignSelf
 * @property string $alignmentBaseline
 * @property string $all
 * @property string $animation
 * @property string $animationDelay
 * @property string $animationDirection
 * @property string $animationDuration
 * @property string $animationFillMode
 * @property string $animationIterationCount
 * @property string $animationName
 * @property string $animationPlayState
 * @property string $animationTimingFunction
 * @property string $appRegion
 * @property string $appearance
 * @property string $ascentOverride
 * @property string $aspectRatio
 * @property string $backdropFilter
 * @property string $backfaceVisibility
 * @property string $background
 * @property string $backgroundAttachment
 * @property string $backgroundBlendMode
 * @property string $backgroundClip
 * @property string $backgroundColor
 * @property string $backgroundImage
 * @property string $backgroundOrigin
 * @property string $backgroundPosition
 * @property string $backgroundPositionX
 * @property string $backgroundPositionY
 * @property string $backgroundRepeat
 * @property string $backgroundRepeatX
 * @property string $backgroundRepeatY
 * @property string $backgroundSize
 * @property string $baselineShift
 * @property string $blockSize
 * @property string $border
 * @property string $borderBlock
 * @property string $borderBlockColor
 * @property string $borderBlockEnd
 * @property string $borderBlockEndColor
 * @property string $borderBlockEndStyle
 * @property string $borderBlockEndWidth
 * @property string $borderBlockStart
 * @property string $borderBlockStartColor
 * @property string $borderBlockStartStyle
 * @property string $borderBlockStartWidth
 * @property string $borderBlockStyle
 * @property string $borderBlockWidth
 * @property string $borderBottom
 * @property string $borderBottomColor
 * @property string $borderBottomLeftRadius
 * @property string $borderBottomRightRadius
 * @property string $borderBottomStyle
 * @property string $borderBottomWidth
 * @property string $borderCollapse
 * @property string $borderColor
 * @property string $borderEndEndRadius
 * @property string $borderEndStartRadius
 * @property string $borderImage
 * @property string $borderImageOutset
 * @property string $borderImageRepeat
 * @property string $borderImageSlice
 * @property string $borderImageSource
 * @property string $borderImageWidth
 * @property string $borderInline
 * @property string $borderInlineColor
 * @property string $borderInlineEnd
 * @property string $borderInlineEndColor
 * @property string $borderInlineEndStyle
 * @property string $borderInlineEndWidth
 * @property string $borderInlineStart
 * @property string $borderInlineStartColor
 * @property string $borderInlineStartStyle
 * @property string $borderInlineStartWidth
 * @property string $borderInlineStyle
 * @property string $borderInlineWidth
 * @property string $borderLeft
 * @property string $borderLeftColor
 * @property string $borderLeftStyle
 * @property string $borderLeftWidth
 * @property string $borderRadius
 * @property string $borderRight
 * @property string $borderRightColor
 * @property string $borderRightStyle
 * @property string $borderRightWidth
 * @property string $borderSpacing
 * @property string $borderStartEndRadius
 * @property string $borderStartStartRadius
 * @property string $borderStyle
 * @property string $borderTop
 * @property string $borderTopColor
 * @property string $borderTopLeftRadius
 * @property string $borderTopRightRadius
 * @property string $borderTopStyle
 * @property string $borderTopWidth
 * @property string $borderWidth
 * @property string $bottom
 * @property string $boxShadow
 * @property string $boxSizing
 * @property string $breakAfter
 * @property string $breakBefore
 * @property string $breakInside
 * @property string $bufferedRendering
 * @property string $captionSide
 * @property string $caretColor
 * @property string $clear
 * @property string $clip
 * @property string $clipPath
 * @property string $clipRule
 * @property string $color
 * @property string $colorInterpolation
 * @property string $colorInterpolationFilters
 * @property string $colorRendering
 * @property string $colorScheme
 * @property string $columnCount
 * @property string $columnFill
 * @property string $columnGap
 * @property string $columnRule
 * @property string $columnRuleColor
 * @property string $columnRuleStyle
 * @property string $columnRuleWidth
 * @property string $columnSpan
 * @property string $columnWidth
 * @property string $columns
 * @property string $contain
 * @property string $containIntrinsicBlockSize
 * @property string $containIntrinsicHeight
 * @property string $containIntrinsicInlineSize
 * @property string $containIntrinsicSize
 * @property string $containIntrinsicWidth
 * @property string $content
 * @property string $contentVisibility
 * @property string $counterIncrement
 * @property string $counterReset
 * @property string $counterSet
 * @property string $cursor
 * @property string $cx
 * @property string $cy
 * @property string $d
 * @property string $descentOverride
 * @property string $direction
 * @property string $display
 * @property string $dominantBaseline
 * @property string $emptyCells
 * @property string $fallback
 * @property string $fill
 * @property string $fillOpacity
 * @property string $fillRule
 * @property string $filter
 * @property string $flex
 * @property string $flexBasis
 * @property string $flexDirection
 * @property string $flexFlow
 * @property string $flexGrow
 * @property string $flexShrink
 * @property string $flexWrap
 * @property string $float
 * @property string $floodColor
 * @property string $floodOpacity
 * @property string $font
 * @property string $fontDisplay
 * @property string $fontFamily
 * @property string $fontFeatureSettings
 * @property string $fontKerning
 * @property string $fontOpticalSizing
 * @property string $fontSize
 * @property string $fontStretch
 * @property string $fontStyle
 * @property string $fontSynthesis
 * @property string $fontSynthesisSmallCaps
 * @property string $fontSynthesisStyle
 * @property string $fontSynthesisWeight
 * @property string $fontVariant
 * @property string $fontVariantCaps
 * @property string $fontVariantEastAsian
 * @property string $fontVariantLigatures
 * @property string $fontVariantNumeric
 * @property string $fontVariationSettings
 * @property string $fontWeight
 * @property string $forcedColorAdjust
 * @property string $gap
 * @property string $grid
 * @property string $gridArea
 * @property string $gridAutoColumns
 * @property string $gridAutoFlow
 * @property string $gridAutoRows
 * @property string $gridColumn
 * @property string $gridColumnEnd
 * @property string $gridColumnGap
 * @property string $gridColumnStart
 * @property string $gridGap
 * @property string $gridRow
 * @property string $gridRowEnd
 * @property string $gridRowGap
 * @property string $gridRowStart
 * @property string $gridTemplate
 * @property string $gridTemplateAreas
 * @property string $gridTemplateColumns
 * @property string $gridTemplateRows
 * @property string $height
 * @property string $hyphens
 * @property string $imageOrientation
 * @property string $imageRendering
 * @property string $inherits
 * @property string $initialValue
 * @property string $inlineSize
 * @property string $inset
 * @property string $insetBlock
 * @property string $insetBlockEnd
 * @property string $insetBlockStart
 * @property string $insetInline
 * @property string $insetInlineEnd
 * @property string $insetInlineStart
 * @property string $isolation
 * @property string $justifyContent
 * @property string $justifyItems
 * @property string $justifySelf
 * @property string $left
 * @property string $letterSpacing
 * @property string $lightingColor
 * @property string $lineBreak
 * @property string $lineGapOverride
 * @property string $lineHeight
 * @property string $listStyle
 * @property string $listStyleImage
 * @property string $listStylePosition
 * @property string $listStyleType
 * @property string $margin
 * @property string $marginBlock
 * @property string $marginBlockEnd
 * @property string $marginBlockStart
 * @property string $marginBottom
 * @property string $marginInline
 * @property string $marginInlineEnd
 * @property string $marginInlineStart
 * @property string $marginLeft
 * @property string $marginRight
 * @property string $marginTop
 * @property string $marker
 * @property string $markerEnd
 * @property string $markerMid
 * @property string $markerStart
 * @property string $mask
 * @property string $maskType
 * @property string $maxBlockSize
 * @property string $maxHeight
 * @property string $maxInlineSize
 * @property string $maxWidth
 * @property string $maxZoom
 * @property string $minBlockSize
 * @property string $minHeight
 * @property string $minInlineSize
 * @property string $minWidth
 * @property string $minZoom
 * @property string $mixBlendMode
 * @property string $negative
 * @property string $objectFit
 * @property string $objectPosition
 * @property string $offset
 * @property string $offsetDistance
 * @property string $offsetPath
 * @property string $offsetRotate
 * @property string $opacity
 * @property string $order
 * @property string $orientation
 * @property string $orphans
 * @property string $outline
 * @property string $outlineColor
 * @property string $outlineOffset
 * @property string $outlineStyle
 * @property string $outlineWidth
 * @property string $overflow
 * @property string $overflowAnchor
 * @property string $overflowClipMargin
 * @property string $overflowWrap
 * @property string $overflowX
 * @property string $overflowY
 * @property string $overscrollBehavior
 * @property string $overscrollBehaviorBlock
 * @property string $overscrollBehaviorInline
 * @property string $overscrollBehaviorX
 * @property string $overscrollBehaviorY
 * @property string $pad
 * @property string $padding
 * @property string $paddingBlock
 * @property string $paddingBlockEnd
 * @property string $paddingBlockStart
 * @property string $paddingBottom
 * @property string $paddingInline
 * @property string $paddingInlineEnd
 * @property string $paddingInlineStart
 * @property string $paddingLeft
 * @property string $paddingRight
 * @property string $paddingTop
 * @property string $page
 * @property string $pageBreakAfter
 * @property string $pageBreakBefore
 * @property string $pageBreakInside
 * @property string $pageOrientation
 * @property string $paintOrder
 * @property string $perspective
 * @property string $perspectiveOrigin
 * @property string $placeContent
 * @property string $placeItems
 * @property string $placeSelf
 * @property string $pointerEvents
 * @property string $position
 * @property string $prefix
 * @property string $quotes
 * @property string $r
 * @property string $range
 * @property string $resize
 * @property string $right
 * @property string $rowGap
 * @property string $rubyPosition
 * @property string $rx
 * @property string $ry
 * @property string $scrollBehavior
 * @property string $scrollMargin
 * @property string $scrollMarginBlock
 * @property string $scrollMarginBlockEnd
 * @property string $scrollMarginBlockStart
 * @property string $scrollMarginBottom
 * @property string $scrollMarginInline
 * @property string $scrollMarginInlineEnd
 * @property string $scrollMarginInlineStart
 * @property string $scrollMarginLeft
 * @property string $scrollMarginRight
 * @property string $scrollMarginTop
 * @property string $scrollPadding
 * @property string $scrollPaddingBlock
 * @property string $scrollPaddingBlockEnd
 * @property string $scrollPaddingBlockStart
 * @property string $scrollPaddingBottom
 * @property string $scrollPaddingInline
 * @property string $scrollPaddingInlineEnd
 * @property string $scrollPaddingInlineStart
 * @property string $scrollPaddingLeft
 * @property string $scrollPaddingRight
 * @property string $scrollPaddingTop
 * @property string $scrollSnapAlign
 * @property string $scrollSnapStop
 * @property string $scrollSnapType
 * @property string $scrollbarGutter
 * @property string $shapeImageThreshold
 * @property string $shapeMargin
 * @property string $shapeOutside
 * @property string $shapeRendering
 * @property string $size
 * @property string $sizeAdjust
 * @property string $speak
 * @property string $speakAs
 * @property string $src
 * @property string $stopColor
 * @property string $stopOpacity
 * @property string $stroke
 * @property string $strokeDasharray
 * @property string $strokeDashoffset
 * @property string $strokeLinecap
 * @property string $strokeLinejoin
 * @property string $strokeMiterlimit
 * @property string $strokeOpacity
 * @property string $strokeWidth
 * @property string $suffix
 * @property string $symbols
 * @property string $syntax
 * @property string $system
 * @property string $tabSize
 * @property string $tableLayout
 * @property string $textAlign
 * @property string $textAlignLast
 * @property string $textAnchor
 * @property string $textCombineUpright
 * @property string $textDecoration
 * @property string $textDecorationColor
 * @property string $textDecorationLine
 * @property string $textDecorationSkipInk
 * @property string $textDecorationStyle
 * @property string $textDecorationThickness
 * @property string $textEmphasis
 * @property string $textEmphasisColor
 * @property string $textEmphasisPosition
 * @property string $textEmphasisStyle
 * @property string $textIndent
 * @property string $textOrientation
 * @property string $textOverflow
 * @property string $textRendering
 * @property string $textShadow
 * @property string $textSizeAdjust
 * @property string $textTransform
 * @property string $textUnderlineOffset
 * @property string $textUnderlinePosition
 * @property string $top
 * @property string $touchAction
 * @property string $transform
 * @property string $transformBox
 * @property string $transformOrigin
 * @property string $transformStyle
 * @property string $transition
 * @property string $transitionDelay
 * @property string $transitionDuration
 * @property string $transitionProperty
 * @property string $transitionTimingFunction
 * @property string $unicodeBidi
 * @property string $unicodeRange
 * @property string $userSelect
 * @property string $userZoom
 * @property string $vectorEffect
 * @property string $verticalAlign
 * @property string $visibility
 * @property string $webkitAlignContent
 * @property string $webkitAlignItems
 * @property string $webkitAlignSelf
 * @property string $webkitAnimation
 * @property string $webkitAnimationDelay
 * @property string $webkitAnimationDirection
 * @property string $webkitAnimationDuration
 * @property string $webkitAnimationFillMode
 * @property string $webkitAnimationIterationCount
 * @property string $webkitAnimationName
 * @property string $webkitAnimationPlayState
 * @property string $webkitAnimationTimingFunction
 * @property string $webkitAppRegion
 * @property string $webkitAppearance
 * @property string $webkitBackfaceVisibility
 * @property string $webkitBackgroundClip
 * @property string $webkitBackgroundOrigin
 * @property string $webkitBackgroundSize
 * @property string $webkitBorderAfter
 * @property string $webkitBorderAfterColor
 * @property string $webkitBorderAfterStyle
 * @property string $webkitBorderAfterWidth
 * @property string $webkitBorderBefore
 * @property string $webkitBorderBeforeColor
 * @property string $webkitBorderBeforeStyle
 * @property string $webkitBorderBeforeWidth
 * @property string $webkitBorderBottomLeftRadius
 * @property string $webkitBorderBottomRightRadius
 * @property string $webkitBorderEnd
 * @property string $webkitBorderEndColor
 * @property string $webkitBorderEndStyle
 * @property string $webkitBorderEndWidth
 * @property string $webkitBorderHorizontalSpacing
 * @property string $webkitBorderImage
 * @property string $webkitBorderRadius
 * @property string $webkitBorderStart
 * @property string $webkitBorderStartColor
 * @property string $webkitBorderStartStyle
 * @property string $webkitBorderStartWidth
 * @property string $webkitBorderTopLeftRadius
 * @property string $webkitBorderTopRightRadius
 * @property string $webkitBorderVerticalSpacing
 * @property string $webkitBoxAlign
 * @property string $webkitBoxDecorationBreak
 * @property string $webkitBoxDirection
 * @property string $webkitBoxFlex
 * @property string $webkitBoxOrdinalGroup
 * @property string $webkitBoxOrient
 * @property string $webkitBoxPack
 * @property string $webkitBoxReflect
 * @property string $webkitBoxShadow
 * @property string $webkitBoxSizing
 * @property string $webkitClipPath
 * @property string $webkitColumnBreakAfter
 * @property string $webkitColumnBreakBefore
 * @property string $webkitColumnBreakInside
 * @property string $webkitColumnCount
 * @property string $webkitColumnGap
 * @property string $webkitColumnRule
 * @property string $webkitColumnRuleColor
 * @property string $webkitColumnRuleStyle
 * @property string $webkitColumnRuleWidth
 * @property string $webkitColumnSpan
 * @property string $webkitColumnWidth
 * @property string $webkitColumns
 * @property string $webkitFilter
 * @property string $webkitFlex
 * @property string $webkitFlexBasis
 * @property string $webkitFlexDirection
 * @property string $webkitFlexFlow
 * @property string $webkitFlexGrow
 * @property string $webkitFlexShrink
 * @property string $webkitFlexWrap
 * @property string $webkitFontFeatureSettings
 * @property string $webkitFontSmoothing
 * @property string $webkitHighlight
 * @property string $webkitHyphenateCharacter
 * @property string $webkitJustifyContent
 * @property string $webkitLineBreak
 * @property string $webkitLineClamp
 * @property string $webkitLocale
 * @property string $webkitLogicalHeight
 * @property string $webkitLogicalWidth
 * @property string $webkitMarginAfter
 * @property string $webkitMarginBefore
 * @property string $webkitMarginEnd
 * @property string $webkitMarginStart
 * @property string $webkitMask
 * @property string $webkitMaskBoxImage
 * @property string $webkitMaskBoxImageOutset
 * @property string $webkitMaskBoxImageRepeat
 * @property string $webkitMaskBoxImageSlice
 * @property string $webkitMaskBoxImageSource
 * @property string $webkitMaskBoxImageWidth
 * @property string $webkitMaskClip
 * @property string $webkitMaskComposite
 * @property string $webkitMaskImage
 * @property string $webkitMaskOrigin
 * @property string $webkitMaskPosition
 * @property string $webkitMaskPositionX
 * @property string $webkitMaskPositionY
 * @property string $webkitMaskRepeat
 * @property string $webkitMaskRepeatX
 * @property string $webkitMaskRepeatY
 * @property string $webkitMaskSize
 * @property string $webkitMaxLogicalHeight
 * @property string $webkitMaxLogicalWidth
 * @property string $webkitMinLogicalHeight
 * @property string $webkitMinLogicalWidth
 * @property string $webkitOpacity
 * @property string $webkitOrder
 * @property string $webkitPaddingAfter
 * @property string $webkitPaddingBefore
 * @property string $webkitPaddingEnd
 * @property string $webkitPaddingStart
 * @property string $webkitPerspective
 * @property string $webkitPerspectiveOrigin
 * @property string $webkitPerspectiveOriginX
 * @property string $webkitPerspectiveOriginY
 * @property string $webkitPrintColorAdjust
 * @property string $webkitRtlOrdering
 * @property string $webkitRubyPosition
 * @property string $webkitShapeImageThreshold
 * @property string $webkitShapeMargin
 * @property string $webkitShapeOutside
 * @property string $webkitTapHighlightColor
 * @property string $webkitTextCombine
 * @property string $webkitTextDecorationsInEffect
 * @property string $webkitTextEmphasis
 * @property string $webkitTextEmphasisColor
 * @property string $webkitTextEmphasisPosition
 * @property string $webkitTextEmphasisStyle
 * @property string $webkitTextFillColor
 * @property string $webkitTextOrientation
 * @property string $webkitTextSecurity
 * @property string $webkitTextSizeAdjust
 * @property string $webkitTextStroke
 * @property string $webkitTextStrokeColor
 * @property string $webkitTextStrokeWidth
 * @property string $webkitTransform
 * @property string $webkitTransformOrigin
 * @property string $webkitTransformOriginX
 * @property string $webkitTransformOriginY
 * @property string $webkitTransformOriginZ
 * @property string $webkitTransformStyle
 * @property string $webkitTransition
 * @property string $webkitTransitionDelay
 * @property string $webkitTransitionDuration
 * @property string $webkitTransitionProperty
 * @property string $webkitTransitionTimingFunction
 * @property string $webkitUserDrag
 * @property string $webkitUserModify
 * @property string $webkitUserSelect
 * @property string $webkitWritingMode
 * @property string $whiteSpace
 * @property string $widows
 * @property string $width
 * @property string $willChange
 * @property string $wordBreak
 * @property string $wordSpacing
 * @property string $wordWrap
 * @property string $writingMode
 * @property string $x
 * @property string $y
 * @property string $zIndex
 * @property string $zoom
 * @property string $cssText
 * @property string $cssFloat
 * @property-read string $length
 */

class CSSStyleDeclaration
{
    private $node;

    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    /**
     * Returns a CSS property name by its index, or the empty string if the index is out-of-bounds.
     */
    function item(int $index): string
    {
        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            if (!$v) continue;
            list($a, $b) = explode(":", $v);
            $values[] = trim($a);
        }
        return $values[$index] ?? "";
    }

    /**
     * Removes a property from the CSS declaration block
     */
    public function removeProperty(string $property)
    {
        $old_value = $this->__get($property);
        $this->__set($property, null);
        return $old_value;
    }

    /**
     * Returns the property value given a property name.
     */
    function getPropertyValue(string $property): string
    {
        return $this->__get($property) ?? "";
    }

    /**
     * Modifies an existing CSS property or creates a new CSS property in the declaration block.
     */
    function setProperty(string $property, string $value, string $priority = null)
    {
        $this->__set($property, $value);
    }

    public function __set($name, $value)
    {
        if ($name == "cssText") {
            $this->node->nodeValue = $value;
            return;
        }

        if ($name == "cssFloat") {
            $name = "float";
        }

        if ($name == "length") {
            return;
        }

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            if (!$v) continue;
            list($a, $b) = explode(":", $v);
            $values[trim($a)] = trim($b);
        }


        if (is_null($value)) {
            unset($values[$name]);
        } else {
            $values[$name] = $value;
        }

        $str = [];
        foreach ($values as $n => $v) {
            $str[] = $n . ": $v";
        }


        $this->node->nodeValue = implode("; ", $str);
    }

    public function __get($name)
    {
        if ($name == "cssText") {
            return $this->node->nodeValue;
        }

        if ($name == "cssFloat") {
            $name = "float";
        }

        if ($name == "length") {
            return count(explode(";", $this->node->nodeValue));
        }

        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            list($a, $b) = explode(":", $v);
            $values[$a] = trim($b);
        }

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);


        return $values[$name];
    }
}
