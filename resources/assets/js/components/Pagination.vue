<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-bind:class="{ disabled: source.current_page == 1 }">
            <a class="page-link" href="#" v-on:click="nextPrev($event, source.current_page-1)" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
                <li v-bind:class="{active: source.current_page == page}" v-for="page in pages">
                    <a class="page-link" href="#" v-on:click="navigate($event, page)">{{page}}</a>
                </li>

                <li v-bind:class="{ disabled: source.current_page == source.last_page }">
                <a class="page-link" href="#" v-on:click="nextPrev($event, source.current_page+1)" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import { range } from 'lodash'
    export default {
        props: ['source'],
        data (){
            return {
                pages: []
            }
        },
        watch:{
            source(){
                this.pages = range(1, this.source.last_page+1)
                
            }
        },
        methods:{
            navigate(ev, page){
                ev.preventDefault()
                this.$emit('navigate', page)
            },
            nextPrev(ev, page){
                if(page == 0 || page == this.source.last_page+1){
                    return;
                }

                this.navigate(ev, page)
            }
        },
    }
</script>