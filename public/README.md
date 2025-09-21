# Coding Rules

# Basic directionality as a whole

Firstly, since there is a mission that should be accomplished this time, the basic directionality has been decided before the development of concrete rules.


1. Anybody can conform to the rules (Will definitely hold down the learning costs)
2. Even if the code becomes a little redundant, we will adopt the one that is clear and has a lower learning cost.
3. Since we are comprised of inexperienced staff, we want to avoid things that must be judged according to experience as much as possible.
4. To make it clear which part of which file you write on (Divide the files by prefix ? Describe later)
5. ? Again, avoid things that arrive from experience.
6. Do not deviate from the rules established by the head office
7. We will develop rules independently, but we must think about cooperation, things such as basic naming rules should succeed the one from the head office.
8. A premise that CSS preprocessors such as Sass will not be used
9. Prevent situations were revision can only be done by the authorized staff. However, it is not limited to that in the future.

We wanted to put things like not depending on a specific tool (like Dreamweaver) because not all the staff use the same tools, but since we are using and managing templates from Dreamweaver in the present state, we have decided to exclude it.  
In addition, from the viewpoint of balance between cutting of the account cost and usability, Brackets will be used as the editor for the Wordpress team.


# What we want to expect by coding

After having decided the basic directionality, we think that having the following action appear during coding work would be nice. We are doubtful.


- Will not break ? Most important!!
- Since we often work with multiple people, we want to avoid things like an unaimed point somewhere breaking when a staff who does understand the whole CSS touch something. (We've all experienced that, right?)
- Will not become a spaghetti source
- By enforcing the rules, we want to make an environment where the staff can point out any odd parts to each other.
- Removal of codes that deviate from the rules (Broken Windows Theory).
- Will know immediately where to revise
- Our company always advocate to "Organize Data" in the slogan, but we are lacking one more step to take roots in everyone.
- We want to expect that organizing is done naturally by conforming to this rule.
- CSS adaptation to Wordpress will be easy to do
- By assuming that each CSS is indepndent, we can expect that it will be easy to do work to prepare the appearance of WP's preview post screen.
- Thing like the WSIWYG icon on the post screen is not working happens quite often, does't it?

As mentioned above, since it is in view of the present system, will put the weight towards "basic thinking as a whole", and we want to decide that it is OK if the outcome expected from CSS will come out as a result.



# Concrete Rules

First, we categorized each element into the following five using SMACSS as a reference and made a change to our company's CSS file constitution.


## Our company's CSS file constitution

Basically followed the head office's rules and made partial changes to the following 6 files.

- normalize.css
- base.css
- layout.css
- component.css
- style.css
- print.css

Deciding which of these files should each style be written on is the same as naming the class name and is a problem that troubles you every time, but we will take the method where we add a prefix to the category that will be explained later on and it divides the files into every prefix.  
By doing this, it will be automatically decided which CSS to input it in when you do HTML coding.


## The 5 Categorization

### 1. Base
Things that are directly set to the tag such as broswer reset and html, or body and a element are assumed as "Base".  
Things related to reset will be written as �normalize.css", and things that are directly set to the tag will be written as "base.css".  
Thus, these files are directly set to the elements.  
Only this category will not begin with a prefix.
> E.g.) html, p, a:hover, etc.

### 2. Layout
Things that only come out once as the outline of the constitution and things concerning the grid layout are assumed as "Layout".  
Put a prefix (l_) on the layout, and write it as "layout.css".  
The Modifier which will come out after this, will also be described in the layout.css, but since we will be assuming the rule which uses the selector that appoints the class name at the same time, it will all begin with a [.l_].  
Thus, all "layout.css" will begin with (.l_).
> E.g.) .l_header, .l_main, .l_footer, etc.

### 3. Component
All objects that are reusable will be assumed as "Component".  
Put a prefix (c_) on the component, and write it as "component.css".  
Thus, "component.css" will begin with (.c_).  
A "Modifier" that will appear later will also be written as "component.css", but since there is a rule to use the selector that designates a class name at the same time, it will all begin with ".c_" as a result.
> E.g.) .c_btn, .c_form, .c_logo, etc.

There may be times where you will be confused if it is the layout or the component, but just decide to entrust it to the judgement of the worker.
You may disagree with the use learned from experience, but by clearly stating the prefix, in my opinion there is no problem as long as we know which they are divided into.

### 4. Modifier
Anything that is in a different state such as difference in width of the layout, component's color variation,or setting when there is mouse over are assumed as Modifier.  
Put a prefix (has_) for the layout's modifier, and write it right under each layout from layout.css.  
Put a prefic (is_) for the component's modifier, and write it right under each component from component.css.

Thus, it will be that (has_) is the only one that will be appointed together with the prefix (l_), and (is_) is the only one that will be appointed together with the prefix (c_). 
 
Anything that is different in design which does not include implication will be distinguished by numbers such as "type00".  
In addition, the component name must be included right after "is_".  
In accordance to what was previously stated, there will be a rule when writing after (.c_), it must be written with no spaces.  
> E.g.) .c_btn.is_btn_blue, .c_form.is_form_large, .c_logo.is_logo_type01, etc.

### 5. Utility
Anything used for general purpose such as setting for every page exluding those mentioned above, position adjustment, and text decoration are assumed as "Utility".  
Put a prefix (u_), and write is as "style.css".  
"clearfix" will be written in "style.css", but as an exception, will not put a prefix on "clearfix".
> E.g.) .clearfix, .u_mab10, .u_ALcenter, etc.

In addition, for settings used only for that page, the id of the body should be added to the prefix.

> E.g.) In the case of the company president's greeting page (body id="greeting")
.u_gretting_red, .u_gretting_mab100, .u_greeting_sanserif, etc.


## Naming Rules

- Must attach an appropriate prefix.
- According to the "The Five Categorization".
- [_"underscore"] will be used for the end of the element and the word.
- You may think that it is hard to identify the end between tehe component and modifier, but it is clear because of the rule for adding the prefix.
- The following words are omissible.
- nav (navigation), btn (button), ttl (title), img (image), bnr (banner), icn (icon)
- In addition, most of these are already applied in the naming convention of images and are commonly recognized in the office.
- For those not included, they are in a form that basically does not omit and is assumed as "class name".
- Searching in the abbreviation dictionary every time we who are Japanese do not understand even if everybody form the Anglosphere understands... is very troublesome.


## Operatve Rules

- ID will not be used.
- There is no way the level of detail can be calculated every time.
- When it is not the intented result, everybody uses "important" immediately. 
- In that case, only the basic class will be used for CSS.
- In the recent coding neighborhood, this has become the de facto standard.
- However, since there is a rule that waves a peculiar id to the body, we will follow that, but will not use it as CSS.
- A class name will be given to almost all elements.
- However, the use of in-line elements such as span and a for decoration without a class name is possible.
- Multi-class will be adopted
- Directionality where the CSS side will be strengthened, then controlled at the HTML side.
- This is for when working with a number of people, it will be easy to divide the labor between those who make the component and those who make lots of HTML.



# Reference (Japanese)

http://cebupripress.com/blog/coding-rule/

