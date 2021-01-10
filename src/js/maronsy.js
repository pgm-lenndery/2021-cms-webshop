import { returnNode } from 'cutleryjs';

export class Maronsy {
    /**
     * Optional parameters when initializing
     * @param {object} options
     */
    constructor (args) {
        const options = {
            columns: 3,
            container: '.maronsy',
            children: '.maronsy__item',
            columnClass: 'maronsy__column',
            responsive: true,
            gap: 0 + 'px',
            ...args
        }
        
        this.OPTIONS = options;
        this.$container = returnNode(options['container']);
        this.$children = this.$container.querySelectorAll(options['children'])
        
        // if no container is defined, throw error
        if (!this.$container) throw new Error('[Maronsy] Container couldn\'t be found')
        
        // listen to window resize, reorder on resize
        window.addEventListener(
            'resize', 
            ({ currentTarget: { innerWidth: width, innerHeight: height }}) => {
                this.onResize({ width, height })
            }
        );
    }

    init () {
        this.onResize({ width: window.innerWidth })
    }
    
    getCurrentSize (width) {
        const sizes = this.OPTIONS['sizes'];
        
        // sort breakpoints from big to small
        sizes.sort((a, b) => b.breakpoint - a.breakpoint)
        
        // find the breakpoint, closest to the current width
        return sizes.find(({ breakpoint }) => breakpoint <= width)['options'];
    }
    
    createColumns (items) {
        // remove current columns in container
        const $currentColumns = this.$container.querySelectorAll('.maronsy__column');
        [...$currentColumns].map(c => c.remove());
        
        // add items to fresh columns
        items.map((i, index) => {
            // create column
            const $column = document.createElement('div');
            
            // add class
            $column.classList.add(this.OPTIONS['columnClass']);
            
            // fil column with items
            [...i].map(item => 
                $column.append(item)
            );
            
            // apppend column to container
            this.$container.append($column)
        })
    }
    
    loopChildren (args) {
        const options = {
            columns: this.OPTIONS['columns'],
            ...args
        };
        
        // transfer children from columns back to container
        [...this.$children].map(i => 
            this.$container.append(i)
        )
        
        // create new empty array
        const arr = new Array(options['columns']).fill(null);
        
        // get items in container, put in array
        const items = arr.map((val, index) => this.$container.querySelectorAll(`
            ${this.OPTIONS['children']}:nth-child(${options['columns']}n+${index+1})
        `))
                
        // add children to columns
        this.createColumns(items);
    }
    
    onResize ({ width }) {
        const currentSizeOptions = this.getCurrentSize(width);
        
        // edit container
        this.updateContainer(currentSizeOptions);
        
        // loop children with current size options
        this.loopChildren(currentSizeOptions);
    }
    
    updateContainer (sizeOptions) {
        this.$container.setAttribute(
            'data-justify-columns',
            sizeOptions['justifyColumns'] || this.OPTIONS['justifyColumns'],
        )
        this.$container.style.setProperty(
            '--gap', 
            sizeOptions['gap'] || this.OPTIONS['gap']
        )
    }
    
    /**
     * Add an item at the top of the container
     * @param {node} item The item that has to be added to the container
     */
    prepend (item) {
        // redefine children ...
        // add item to container
        // onResize
    }
    
    /**
     * Add an item at the bottom of the container
     * @param {node} item The item that has to be added to the container
     */
    append (item) {
        // redefine children ...
        // add item to container
        // onResize
    }
}

