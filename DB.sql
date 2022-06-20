--
-- PostgreSQL database dump
--

-- Dumped from database version 14.3
-- Dumped by pg_dump version 14.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: measurment_units; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.measurment_units (
    measurment_unit_id uuid DEFAULT gen_random_uuid() NOT NULL,
    measurment_unit_name character varying(255) NOT NULL
);


--
-- Name: permissions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.permissions (
    permission_id uuid DEFAULT gen_random_uuid() NOT NULL,
    permission_name character varying(255) NOT NULL
);


--
-- Name: products; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.products (
    product_id uuid DEFAULT gen_random_uuid() NOT NULL,
    public_product_id uuid,
    user_id uuid NOT NULL,
    product_detail_id uuid NOT NULL
);


--
-- Name: products_details; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.products_details (
    product_detail_id uuid DEFAULT gen_random_uuid() NOT NULL,
    product_name character varying(255) NOT NULL,
    product_description text,
    product_image_url character varying(255),
    measurment_unit_id uuid NOT NULL
);


--
-- Name: public_products; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.public_products (
    public_product_id uuid DEFAULT gen_random_uuid() NOT NULL,
    product_detail_id uuid NOT NULL
);


--
-- Name: public_recipes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.public_recipes (
    public_recipe_id uuid DEFAULT gen_random_uuid() NOT NULL,
    recipe_detail_id uuid NOT NULL
);


--
-- Name: recipes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.recipes (
    recipe_id uuid DEFAULT gen_random_uuid() NOT NULL,
    public_recipe_id uuid,
    user_id uuid NOT NULL,
    recipe_detail_id uuid NOT NULL
);


--
-- Name: recipes_details; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.recipes_details (
    recipe_detail_id uuid NOT NULL,
    recipe_description text,
    recipe_image_url character varying(255)
);


--
-- Name: recipes_ingredients; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.recipes_ingredients (
    recipe_detail_id uuid NOT NULL,
    product_id uuid NOT NULL,
    product_amount numeric NOT NULL
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    user_id uuid DEFAULT gen_random_uuid() NOT NULL,
    user_email character varying(255) NOT NULL,
    user_password character varying(255) NOT NULL
);


--
-- Name: users_permissions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users_permissions (
    user_id uuid NOT NULL,
    permission_id uuid NOT NULL
);


--
-- Data for Name: measurment_units; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.measurment_units (measurment_unit_id, measurment_unit_name) FROM stdin;
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.permissions (permission_id, permission_name) FROM stdin;
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.products (product_id, public_product_id, user_id, product_detail_id) FROM stdin;
\.


--
-- Data for Name: products_details; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.products_details (product_detail_id, product_name, product_description, product_image_url, measurment_unit_id) FROM stdin;
\.


--
-- Data for Name: public_products; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.public_products (public_product_id, product_detail_id) FROM stdin;
\.


--
-- Data for Name: public_recipes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.public_recipes (public_recipe_id, recipe_detail_id) FROM stdin;
\.


--
-- Data for Name: recipes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.recipes (recipe_id, public_recipe_id, user_id, recipe_detail_id) FROM stdin;
\.


--
-- Data for Name: recipes_details; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.recipes_details (recipe_detail_id, recipe_description, recipe_image_url) FROM stdin;
\.


--
-- Data for Name: recipes_ingredients; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.recipes_ingredients (recipe_detail_id, product_id, product_amount) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (user_id, user_email, user_password) FROM stdin;
\.


--
-- Data for Name: users_permissions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users_permissions (user_id, permission_id) FROM stdin;
\.


--
-- Name: measurment_units measurment_units_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.measurment_units
    ADD CONSTRAINT measurment_units_pkey PRIMARY KEY (measurment_unit_id);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (permission_id);


--
-- Name: products_details products_details_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products_details
    ADD CONSTRAINT products_details_pkey PRIMARY KEY (product_detail_id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (product_id);


--
-- Name: public_products public_products_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.public_products
    ADD CONSTRAINT public_products_pkey PRIMARY KEY (public_product_id);


--
-- Name: public_recipes public_recipes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.public_recipes
    ADD CONSTRAINT public_recipes_pkey PRIMARY KEY (public_recipe_id);


--
-- Name: recipes_details recipes_details_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes_details
    ADD CONSTRAINT recipes_details_pkey PRIMARY KEY (recipe_detail_id);


--
-- Name: recipes_ingredients recipes_ingredients_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes_ingredients
    ADD CONSTRAINT recipes_ingredients_pkey PRIMARY KEY (recipe_detail_id, product_id);


--
-- Name: recipes recipes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_pkey PRIMARY KEY (recipe_id);


--
-- Name: users_permissions users_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users_permissions
    ADD CONSTRAINT users_permissions_pkey PRIMARY KEY (user_id, permission_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: products_details products_details_measurment_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products_details
    ADD CONSTRAINT products_details_measurment_unit_id_fkey FOREIGN KEY (measurment_unit_id) REFERENCES public.measurment_units(measurment_unit_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: products products_product_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_product_detail_id_fkey FOREIGN KEY (product_detail_id) REFERENCES public.products_details(product_detail_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: products products_public_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_public_product_id_fkey FOREIGN KEY (public_product_id) REFERENCES public.public_products(public_product_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: products products_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public_products public_products_product_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.public_products
    ADD CONSTRAINT public_products_product_detail_id_fkey FOREIGN KEY (product_detail_id) REFERENCES public.products_details(product_detail_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public_recipes public_recipes_recipe_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.public_recipes
    ADD CONSTRAINT public_recipes_recipe_detail_id_fkey FOREIGN KEY (recipe_detail_id) REFERENCES public.recipes_details(recipe_detail_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: recipes_ingredients recipes_ingredients_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes_ingredients
    ADD CONSTRAINT recipes_ingredients_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: recipes_ingredients recipes_ingredients_recipe_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes_ingredients
    ADD CONSTRAINT recipes_ingredients_recipe_detail_id_fkey FOREIGN KEY (recipe_detail_id) REFERENCES public.recipes_details(recipe_detail_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: recipes recipes_public_recipe_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_public_recipe_id_fkey FOREIGN KEY (public_recipe_id) REFERENCES public.public_recipes(public_recipe_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: recipes recipes_recipe_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_recipe_detail_id_fkey FOREIGN KEY (recipe_detail_id) REFERENCES public.recipes_details(recipe_detail_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: recipes recipes_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_permissions users_permissions_permission_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users_permissions
    ADD CONSTRAINT users_permissions_permission_id_fkey FOREIGN KEY (permission_id) REFERENCES public.permissions(permission_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_permissions users_permissions_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users_permissions
    ADD CONSTRAINT users_permissions_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) ON UPDATE CASCADE ON DELETE CASCADE;

create view users_products
            (user_id, product_id, product_detail_id, product_name, product_description, product_image_url,
             measurment_unit_id) as
SELECT u.user_id,
       p.product_id,
       p.product_detail_id,
       pd.product_name,
       pd.product_description,
       pd.product_image_url,
       pd.measurment_unit_id
FROM users u
         JOIN products p ON u.user_id = p.user_id
         JOIN products_details pd ON p.product_detail_id = pd.product_detail_id;

alter table users_products;

--
-- PostgreSQL database dump complete
--
