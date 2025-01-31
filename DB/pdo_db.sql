PGDMP         $             	    |            pdo    15.8    15.8 +    '           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            (           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            )           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            *           1262    33667    pdo    DATABASE     y   CREATE DATABASE pdo WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE pdo;
                postgres    false            �            1259    33705 	   categoria    TABLE     �   CREATE TABLE public.categoria (
    categoria_id integer NOT NULL,
    categoria_nombre character varying(50) NOT NULL,
    categoria_ubicacion character varying(150) NOT NULL
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            �            1259    33704    categoria_categoria_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categoria_categoria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.categoria_categoria_id_seq;
       public          postgres    false    219            +           0    0    categoria_categoria_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.categoria_categoria_id_seq OWNED BY public.categoria.categoria_id;
          public          postgres    false    218            �            1259    33712    producto    TABLE     �  CREATE TABLE public.producto (
    producto_id integer NOT NULL,
    producto_codigo character varying(70) NOT NULL,
    producto_nombre character varying(70) NOT NULL,
    producto_peso numeric(30,2) NOT NULL,
    producto_precio numeric(30,2) NOT NULL,
    producto_stock integer NOT NULL,
    producto_foto character varying(500) NOT NULL,
    categoria_id integer NOT NULL,
    usuario_id integer NOT NULL
);
    DROP TABLE public.producto;
       public         heap    postgres    false            �            1259    33711    producto_producto_id_seq    SEQUENCE     �   CREATE SEQUENCE public.producto_producto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.producto_producto_id_seq;
       public          postgres    false    221            ,           0    0    producto_producto_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.producto_producto_id_seq OWNED BY public.producto.producto_id;
          public          postgres    false    220            �            1259    33731    producto_vendido    TABLE     �   CREATE TABLE public.producto_vendido (
    pv_id integer NOT NULL,
    venta_id integer NOT NULL,
    producto_id integer NOT NULL,
    pv_stock integer NOT NULL,
    pv_total integer NOT NULL
);
 $   DROP TABLE public.producto_vendido;
       public         heap    postgres    false            �            1259    33730    producto_vendido_pv_id_seq    SEQUENCE     �   CREATE SEQUENCE public.producto_vendido_pv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.producto_vendido_pv_id_seq;
       public          postgres    false    223            -           0    0    producto_vendido_pv_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.producto_vendido_pv_id_seq OWNED BY public.producto_vendido.pv_id;
          public          postgres    false    222            �            1259    33690    usuario    TABLE     B  CREATE TABLE public.usuario (
    usuario_id integer NOT NULL,
    usuario_nombre character varying(40) NOT NULL,
    usuario_apellido character varying(40) NOT NULL,
    usuario_usuario character varying(20) NOT NULL,
    usuario_clave character varying(200) NOT NULL,
    usuario_email character varying(70) NOT NULL
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            �            1259    33689    usuario_usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 3
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.usuario_usuario_id_seq;
       public          postgres    false    215            .           0    0    usuario_usuario_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.usuario_usuario_id_seq OWNED BY public.usuario.usuario_id;
          public          postgres    false    214            �            1259    33697    venta    TABLE     �   CREATE TABLE public.venta (
    venta_id integer NOT NULL,
    venta_codigo character varying(70) NOT NULL,
    venta_fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.venta;
       public         heap    postgres    false            �            1259    33696    venta_venta_id_seq    SEQUENCE     �   CREATE SEQUENCE public.venta_venta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.venta_venta_id_seq;
       public          postgres    false    217            /           0    0    venta_venta_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.venta_venta_id_seq OWNED BY public.venta.venta_id;
          public          postgres    false    216            |           2604    33708    categoria categoria_id    DEFAULT     �   ALTER TABLE ONLY public.categoria ALTER COLUMN categoria_id SET DEFAULT nextval('public.categoria_categoria_id_seq'::regclass);
 E   ALTER TABLE public.categoria ALTER COLUMN categoria_id DROP DEFAULT;
       public          postgres    false    219    218    219            }           2604    33715    producto producto_id    DEFAULT     |   ALTER TABLE ONLY public.producto ALTER COLUMN producto_id SET DEFAULT nextval('public.producto_producto_id_seq'::regclass);
 C   ALTER TABLE public.producto ALTER COLUMN producto_id DROP DEFAULT;
       public          postgres    false    221    220    221            ~           2604    33734    producto_vendido pv_id    DEFAULT     �   ALTER TABLE ONLY public.producto_vendido ALTER COLUMN pv_id SET DEFAULT nextval('public.producto_vendido_pv_id_seq'::regclass);
 E   ALTER TABLE public.producto_vendido ALTER COLUMN pv_id DROP DEFAULT;
       public          postgres    false    223    222    223            y           2604    33693    usuario usuario_id    DEFAULT     x   ALTER TABLE ONLY public.usuario ALTER COLUMN usuario_id SET DEFAULT nextval('public.usuario_usuario_id_seq'::regclass);
 A   ALTER TABLE public.usuario ALTER COLUMN usuario_id DROP DEFAULT;
       public          postgres    false    215    214    215            z           2604    33700    venta venta_id    DEFAULT     p   ALTER TABLE ONLY public.venta ALTER COLUMN venta_id SET DEFAULT nextval('public.venta_venta_id_seq'::regclass);
 =   ALTER TABLE public.venta ALTER COLUMN venta_id DROP DEFAULT;
       public          postgres    false    217    216    217                       0    33705 	   categoria 
   TABLE DATA           X   COPY public.categoria (categoria_id, categoria_nombre, categoria_ubicacion) FROM stdin;
    public          postgres    false    219   4       "          0    33712    producto 
   TABLE DATA           �   COPY public.producto (producto_id, producto_codigo, producto_nombre, producto_peso, producto_precio, producto_stock, producto_foto, categoria_id, usuario_id) FROM stdin;
    public          postgres    false    221   B4       $          0    33731    producto_vendido 
   TABLE DATA           \   COPY public.producto_vendido (pv_id, venta_id, producto_id, pv_stock, pv_total) FROM stdin;
    public          postgres    false    223   �4                 0    33690    usuario 
   TABLE DATA           ~   COPY public.usuario (usuario_id, usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) FROM stdin;
    public          postgres    false    215   �4                 0    33697    venta 
   TABLE DATA           D   COPY public.venta (venta_id, venta_codigo, venta_fecha) FROM stdin;
    public          postgres    false    217   �5       0           0    0    categoria_categoria_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.categoria_categoria_id_seq', 1, false);
          public          postgres    false    218            1           0    0    producto_producto_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.producto_producto_id_seq', 1, false);
          public          postgres    false    220            2           0    0    producto_vendido_pv_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.producto_vendido_pv_id_seq', 1, false);
          public          postgres    false    222            3           0    0    usuario_usuario_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.usuario_usuario_id_seq', 4, true);
          public          postgres    false    214            4           0    0    venta_venta_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.venta_venta_id_seq', 1, false);
          public          postgres    false    216            �           2606    33710    categoria categoria_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (categoria_id);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    219            �           2606    33719    producto producto_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (producto_id);
 @   ALTER TABLE ONLY public.producto DROP CONSTRAINT producto_pkey;
       public            postgres    false    221            �           2606    33736 &   producto_vendido producto_vendido_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.producto_vendido
    ADD CONSTRAINT producto_vendido_pkey PRIMARY KEY (pv_id);
 P   ALTER TABLE ONLY public.producto_vendido DROP CONSTRAINT producto_vendido_pkey;
       public            postgres    false    223            �           2606    33695    usuario usuario_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (usuario_id);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    215            �           2606    33703    venta venta_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.venta
    ADD CONSTRAINT venta_pkey PRIMARY KEY (venta_id);
 :   ALTER TABLE ONLY public.venta DROP CONSTRAINT venta_pkey;
       public            postgres    false    217            �           2606    33720 #   producto producto_categoria_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_categoria_id_fkey FOREIGN KEY (categoria_id) REFERENCES public.categoria(categoria_id);
 M   ALTER TABLE ONLY public.producto DROP CONSTRAINT producto_categoria_id_fkey;
       public          postgres    false    3204    221    219            �           2606    33725 !   producto producto_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(usuario_id);
 K   ALTER TABLE ONLY public.producto DROP CONSTRAINT producto_usuario_id_fkey;
       public          postgres    false    221    3200    215            �           2606    33742 2   producto_vendido producto_vendido_producto_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.producto_vendido
    ADD CONSTRAINT producto_vendido_producto_id_fkey FOREIGN KEY (producto_id) REFERENCES public.producto(producto_id);
 \   ALTER TABLE ONLY public.producto_vendido DROP CONSTRAINT producto_vendido_producto_id_fkey;
       public          postgres    false    3206    221    223            �           2606    33737 /   producto_vendido producto_vendido_venta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.producto_vendido
    ADD CONSTRAINT producto_vendido_venta_id_fkey FOREIGN KEY (venta_id) REFERENCES public.venta(venta_id);
 Y   ALTER TABLE ONLY public.producto_vendido DROP CONSTRAINT producto_vendido_venta_id_fkey;
       public          postgres    false    217    223    3202                '   x�3�LJM�LI,��2���W(HMIM�|N�=... �1	      "   X   x�%�A
� F��?��2��h���F�@��u�����|I�#,����r���̎
xx2d�fi�SΩ�G�G�ab��D t�:"� ���      $      x������ � �         �   x�]��n�0������HEew�)րq$��RVOB[,�0�~g�����O��{(
4t���XTX�������x')/l��QY��ֱJ�:
M�����d�U��.4�]e�0A����ktW�
�x.�>Celݘ�#K�84ne�Q_w�8@���[JL��)��ʕT$vˈ~�{�y�ʦI�}o���~����e~K��z�m��Ç�1�cYYU            x������ � �     