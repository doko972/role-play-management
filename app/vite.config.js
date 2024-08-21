import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        manifest: true,
        outDir: 'dist',
        rollupOptions: {
          input: ['/js/scripts.js']
        },
    },

    
})