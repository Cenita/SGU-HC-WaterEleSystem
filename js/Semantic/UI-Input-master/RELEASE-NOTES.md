### Version 2.3.0 - Feb 20, 2018

To preserve functionality `movePopup` default has remained as `true` (moving the popup to the same offset context), however now setting `movePopup: false` should now always position correctly. Be sure to use `movePopup: true` to avoid issues with `ui popup` inside `menu`, `input` or other places where it may inherit rules from its activating element or its context.

### Version 2.2.14 - Jan 29, 2018

- **Dropdown** - Fixed issue where using `ui input` in a dropdown menu could cause the input to be too wide in some cases **Thanks @banandrew** [#5085](https://github.com/Semantic-Org/Semantic-UI/issues/5085)

### Version 2.2.11 - July 11, 2017

- **Input** - Fix issue where transparent input had a border radius and could cut off descendors [#5281](https://github.com/Semantic-Org/Semantic-UI/issues/5281)
- **Input** - Fixes disabled style being applied twice on input **Thanks @levithomason** [#5284](https://github.com/Semantic-Org/Semantic-UI/issues/5284)

### Version 2.2.10 - March 28, 2017

- **Dropdown** - Fix search input inside dropdown menu causing dropdown to close before selection when selecting an item #5113

#### Dropdown

- **Dropdown** - Dropdown using search input inside of menu are now tabbable [#4490](https://github.com/Semantic-Org/Semantic-UI/pull/4490)
- **Form Validation** - Fixes js error caused by revalidating inputs without validation rules [#4497](https://github.com/Semantic-Org/Semantic-UI/pull/4497) [#4547](https://github.com/Semantic-Org/Semantic-UI/pull/4457) **Thanks @cbxp**
- **Input/Dropdown** - Fixed rounding error causing vertical alignment of `dropdown`, `search`, `input` to sometimes appear off by 1 pixel [#4279](https://github.com/Semantic-Org/Semantic-UI/pull/4279)

### Version 2.2.5 - October, 27, 2016

- **Search** - Fixed issue where input may attempt to refocus when search element is immediately removed from browser's DOM after a result is clicked.
- **Flat Theme** - Fixes inverted input color

### Version 2.2.3 - August 21, 2016

- **Modal** - Modal will now focus first tabable element, not just `input` [#4370](https://github.com/Semantic-Org/Semantic-UI/issues/4370)
- **Form** - Fixed issue where `disabled fields` with radio inputs would not correctly dim the label **Thanks @louwers** [#4366](https://github.com/Semantic-Org/Semantic-UI/issues/4366)
- **Dropdown** - Using `search selection with `selectOnKeydown` and text content that includes html, will not apply html content (like images) to the text until dropdown blur, making sure that content can align correctly with the partial search content of the search input (which cannot include HTML)
- **Form** - `input` styles now apply to `type="file"` **thanks @coldfire79** [#4074](https://github.com/Semantic-Org/Semantic-UI/issues/4074)

### Version 2.2.2 - July 07, 2016

- **Dropdown** - Fixed "pointer" cursor appearing in hitbox above search input in `search selection`, now all input area will appear with "text" input cursor

### Version 2.2.0 - June 26, 2016

- **Dropdown** - Multiple select dropdown now sizes current dropdown input based on rendered width of a hidden element, not using an estimate based on character count. This means search will never break to a second line earlier than would normally fit in current line.
- **Site** - Added new `@inputColor` and `@inputPlaceholderColor` global variables that now control placeholder text styles across all components.
- **Dropdown** - Long dropdown text entry with `allowAdditions` would cause input to mistakingly drop to next line early [#3743](https://github.com/Semantic-Org/Semantic-UI/issues/3743)
- **Dropdown** - Search selection would lose search input focus when clicking on a choice [#3790](https://github.com/Semantic-Org/Semantic-UI/issues/3790)
- **Input** - Fixed `:active` styles appearing on disabled input, when input is disabled using `disabled` property [#3907](https://github.com/Semantic-Org/Semantic-UI/issues/3907)
- **Input** - Fixes issue with `dropdown` or button on the left side of an `action` input not properly rounding

### Version 2.1.3 - Sep 03, 2015

- **Input** - Fixes regression where `ui icon input` inside forms were not correct width [#2953](https://github.com/Semantic-Org/Semantic-UI/issues/2953)
- **Input** - Fixes typo in focused placeholder text color preventing the value from being used [#2939](https://github.com/Semantic-Org/Semantic-UI/issues/2939)
- **Input** - `action input` now correctly show focused border on button side, and avoids duplicating borders

#### Features

- **Dropdown** - Dropdown will now automatically update selected values when hidden input value changes (so long as `change` event is triggered) [#2626](https://github.com/Semantic-Org/Semantic-UI/issues/2626)
- **Input** - Added `disabled` state for inputs [#2694](https://github.com/Semantic-Org/Semantic-UI/issues/2694)
- **Input** - Added ability for labeled input to be attached to both sides [#2922 **Thanks @maturano**](https://github.com/Semantic-Org/Semantic-UI/issues/no**)
- **Form** - `inverted form` now remove input border, added new variables for controlling inverted form input styles

#### Bugs

- **Dropdown** - Fixed issue where "no results" message would be still be visible before search query on input focus [#2824](https://github.com/Semantic-Org/Semantic-UI/issues/2824)
- **Form / Input** - Fixes `::placeholder` text color for `ui error input`, modifies form error placeholder color to distinguish from form value error color [#2786](https://github.com/Semantic-Org/Semantic-UI/issues/2786)
- **Form / Input** - Fixes issue where `ui input` would sometimes collapse to `0px` width, especially when used inside an `inline field` [#2705 [#2621 [#2821](https://github.com/Semantic-Org/Semantic-UI/issues/2821)
- **Form** - Date input and other special input in chrome now are the same height as normal input (adds custom vendor shadow dom styling) [#2704](https://github.com/Semantic-Org/Semantic-UI/issues/2704)
- **Input** - Fixed issue with appearance of `left corner labeled left icon input` [#2782](https://github.com/Semantic-Org/Semantic-UI/issues/2782)
- **Search** - Calling `.search('show results')` no longer fails when input is not focused [#2842](https://github.com/Semantic-Org/Semantic-UI/issues/2842)
- **Dropdown** - Dropdown will no longer fire native `onchange` event on hidden input when setting value during initial load (unless `fireOnInit: true`) #2795 **Thanks @lauri-elevant**
- **Input** - `labeled input` now keeps border on label edge so that focus color appears correctly
- **Input** - Input now will reset `font-weight` and `font-style` if set on parent;
- **Input** `action input` and `labeled input` now have focused border on inner edge with label/button
- **Menu** - Fixed issue with `labeled input` text inside menu not appearing vertically centered

### Version 2.0.4 - July 17, 2015

- **Input** - Fixed `left action input` displaying with incorrect `input` border radius inside `ui form` [#2638](https://github.com/Semantic-Org/Semantic-UI/issues/2638)

### Version 2.0.3 - July 8, 2015

- **Input** - Fixed errored input field having incorrect border radius with `labeled input`

### Version 2.0.0 - June 30, 2015

- **Input** - `pointer-events` have been removed from `icon` in `icon input` unless a `link icon` is used. This is to make sure the hitbox for focusing an input includes the icon.
- **Input** - All `input` types use `flexbox` for layout
- **Site** - Added many new site variables, including the ability to control input size across all UI `inputPadding`, along with more border colors, accents, and colors.
- **Checkbox** - Checkbox will now gracefully correct behaviors invoked on the child input element instead of the `ui checkbox`.
- **Form** - Added placeholder color rules for IE, `ms-input-placeholder`
- **Input** - Added placeholder color rules for IE, `ms-input-placeholder`
- **Input** - Action input now supports multiple buttons, and dropdown
- **Search** - Search `prompt` now has focus styles defined if not using `ui input`
- **Dropdown** - Fixes `onChange` to fire when input value changes, not just when menu UI changes
- **Form** - Form sizes and input sizes now inherit from `site.variables`
- **Form/Input** - `ui labeled input` inside `form` will no longer escape column width. `ui fluid input` will now use input widths shorter than browser default.
- **Input** - Fixed improper left padding on `transparent left icon input` **Thanks @zxfwinder**
- **Input** - Fixed `placeholder` color not changing correctly on focus **Thanks @zxfwinder**
- **Input** - Fixed right padding on `labeled input` that were not `corner labeled`
- **Input** - Input now use `em` instead of `rem` so they will inherit the size of the elements they are nested inside

### Version 1.12.2 - May 4, 2015

- **Dropdown** - Fixed `left` and `right` arrow does not move input cursor with `visible selection dropdown`. Event accidentally prevented by `sub menu` shortcut keys.

### Version 1.12.1 - April 26, 2015

- **Input** - Fixes labeled inputs not adjusting correctly with flex. **Backported from 2.0**
- **Input** - Fixes placeholder text color prefixes for `webkit` **Backport from 2.0**

### Version 1.12.0 - April 13, 2015

- **Input** - Backports fix from `2.x` for `ui fluid input` not appearing correctly.

### Version 1.11.0 - March 3, 2015

- **Input** - Fix bug with vertical centering of `ui action input` inside `menu` due to `flexbox` changes
- **Form** - Added `input[type="search"]` styles to `ui form`

### UI Changes

- **Input** - Input with dropdowns is now much easier, see docs. `action input` and `labeled input` now use `display: flex`. `ui action input` now supports `<button>` tag usage (!) which support `flex` but not `table-cell`
- **Form** - Input rules now apply to `input[type="time"]`

### Version 1.8.1 - January 26, 2015

- **Input** - `ui labeled input` now uses  `flex` added example in ui docs with dropdown
- **Input** - Fix border radius on `ui action input` with button groups, aka `ui buttons`

### Version 1.8.0 - January 23, 2015

- **Form** - Form will now prevent browsers from resubmitting form repeatedly when keydown is pressed on input field.
- **Checkbox** - Checkbox now only modifies `input[type="radio"]` and `input[type="checkbox"]` ignoring any other inputs

### Version 1.7.0 - January 14, 2015

- **Site** - Form input highlighting color added (helps differentiate form colors with autocompleted fields). Default text highlighting color moved from highlighter yellow to a mellow blue.
- **Dropdown** - Search dropdown input can now have backgrounds. Fixes issues with autocompleted search dropdowns which have forced yellow "autocompleted" bg.
- **Dropdown** - Fixes dropdown search input from filtering text values when input is inside menu, i.e "In-Menu Search"

### Version 1.5.0 - December 30, 2014

- **Form** - ``ui input`` now receives the same formatting as a normal input inside an ``inline field``
- **Input** - Fixed bug when ``ui action input`` uses a ``ui icon button``, button was receiving `i.icon` formatting.

### Version 1.4.0 - December 22, 2014

- **Form** - Form inputs without ``type`` specified are now formatted **Thanks PSyton**

### Version 1.3.0 - December 17, 2014

- **Dropdown** - Search Dropdown is now much more responsive, js improvements and input throttling added.Throttling defaults to `50ms` and can be modified with settings ``delay.search``

### Version 1.2.0 - December 08, 2014

- **Checkbox** - JS Checkbox now handles several variations of html. Labels can be before inputs, after, or not included at all. This should work better with server side form generation.

### Version 1.1.0 - December 02, 2014

- **Input** - ``transparent input`` can now be ``inverted``
- **Input** - ``ui action input`` can now accomodate ``ui button`` that adjust padding from default
- **Dropdown** - Fix ``action input`` used inside ``ui dropdown`` to appear correctly **Thanks ordepdev**

### Version 1.0.0 - November 24, 2014

- **Form** - Date field has been removed, use a ``ui icon input`` with a ``calendar icon`` instead
- **Input** - Labeled inputs now have ``corner`` ``left`` and ``top`` label types. Any labeled inputs should be converted to ``corner labeled input`` to preserve functionality from ``0.x``
- **Dropdown** - Many new content types now work inside dropdowns, headers, dividers, images, inputs, labels and more
- **Form** - Inputs now use 1em font size and correctly match selection dropdown height

### Version 0.18.0 - June 6, 2014

- **Modal** - Modals now focus on first input if available **Thanks Knotix**

### Version 0.17.0 - May 9, 2014

- **Form, Input** - Fixes ``ui input`` to work correctly inside ``inline field``

### Version 0.15.5 - April 11, 2014

- **Checkbox** - Fixes ``ui checkbox`` to obey ``disabled`` property of input

### Version 0.15.0 - Mar 14, 2014

- **Form** - Forms, Dropdowns, and Inputs now have matching padding size, and use 1em font size to appear same size as surrounding text
- **Input** - Fixes slight error in corner label rounding **Thanks MohammadYounes**
- **Checkbox** - Checkboxes can now have multiple inputs inside, for use with .NET and other languages that insert their own hidden inputs

### Version 0.13.1 - Feb 28, 2014

- **Input** - Fixes ui input to inherit form sizing

### Version 0.13.0 - Feb 20, 2014

- **Label** - Corner labels now are coupled to have rounded edges with components with rounded edges like input
- **Form Validation** - Form validation now rechecks on all form change events, not just input change

### Version 0.12.4 - Jan 29, 2014

- **Input** - Fixes ``ui buttons`` to work inside an ``ui action input`` **Thanks MohammadYounes **

### Version 0.12.2 - Jan 21, 2014

- **Menu** - Slightly updates input sizes inside menus

### Version 0.12.1 - Jan 15, 2014

- **Menu** - Fixes ``action input`` to work inside menus  **thanks joltmode**

### Version 0.12.0 - Jan 06, 2014

- **Input** - Fixes input placeholder styles to work (accidental regex replace)
- **Input** - Action inputs can now be fluid
- **Form** - Fixes all validation input to be trimmed for whitespace

### Version 0.10.3 - Dec 22, 2013

- **Input** - Removes duplicate sizes

### Version 0.10.2 - Dec 13, 2013

- **Input** - Action inputs now support button groups

### Version 0.10.0 - Dec 05, 2013

- **Form Validation** - Adds two new parameters, to allow for changing of revalidation and delay on input

### Version 0.9.4 - Nov 24, 2013

- **Form** - Adds input type="url" to forms

### Version 0.9.0 - Nov 5, 2013

- **Input** - Labeled icons now have smaller corner labels

### Version 0.8.0 - Oct 25, 2013

- **Input** - Action buttons now have tactile feedback like normal buttons
- Added new examples to button and input

### Version 0.6.2 - Oct 15, 2013

- Fixes input position inside menus with no other content
- Fixes input sizing on small/large menus

### Version 0.3.2 - Oct 2, 2013

- Adds input focus/blur to modal, see Issue #124
- Fixes icon input inside a menu placement issues

### Version 0.2.5 - Sep 28, 2013

- Fixes checkbox  selector issue with multiple inputs inside a checkbox
- Fixes dropdown to now set active item to whatever hidden input field is when using action updateForm

### Version 0.1.0 - Sep 25, 2013

- Added fluid input variation