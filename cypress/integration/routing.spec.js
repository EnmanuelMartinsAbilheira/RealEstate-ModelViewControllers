/// <reference types="cypress" />

describe('prueba la navegacion y routing del header y footer', () => {
    it('Prueba la navegacion del header', () => {
        cy.visit('/');
        cy.get('[data-cy="navagacion-header"]').should('exist');
        cy.get('[data-cy="navagacion-header"]').find('a').should('have.length', 4);
        cy.get('[data-cy="navagacion-header"]').find('a').should('not.have.length', 8);

        //revisar los enlaces sean correctos 
        cy.get('[data-cy="navagacion-header"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navagacion-header"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navagacion-header"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navagacion-header"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');

        cy.get('[data-cy="navagacion-header"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navagacion-header"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navagacion-header"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navagacion-header"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');
    })
    
    it('Prueba la navegacion del footer', () => {
        cy.get('[data-cy="navagacion-footer"]').should('exist');
        cy.get('[data-cy="navagacion-footer"]').should('have.prop', 'class').should('equal', 'navegacion');
        cy.get('[data-cy="navagacion-footer"]').find('a').should('have.length', 4);
        cy.get('[data-cy="navagacion-footer"]').find('a').should('not.have.length', 8);

        //revisar los enlaces sean correctos 
        cy.get('[data-cy="navagacion-footer"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navagacion-footer"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navagacion-footer"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navagacion-footer"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');

        cy.get('[data-cy="navagacion-footer"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navagacion-footer"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navagacion-footer"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navagacion-footer"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');


        cy.get('[data-cy="copyright"]').should('have.prop', 'class').should('equal', 'copyright');
    })
});